<?php
error_reporting (E_ERROR|E_PARSE);
//error_reporting (E_ALL);
set_time_limit(24000);

require_once("class/dbConn.class.php");
require_once("class/uteisMysql.class.php");
require_once("class/ObjectAndXML.php");
require_once("class/funcoes.class.php");
require_once("class/dao/clienteDao.class.php");
require_once("class/dao/pedidoDao.class.php");


class interfaceM50 {

	private $siglaOper = NULL;
	private $siglaFile = NULL;
	private $workDate = NULL;
	private $workTime = NULL;
	private $workHour = NULL;
	private $pathSistema = NULL;
	private $funcoes = NULL;
	private $daoCli = NULL;
	private $daoPed = NULL;

	private $dirOrigem = NULL;
	private $dirProcessados = NULL;
	private $dirDestino = NULL;
	private $dirTratamento = NULL;

	private $logs = NULL;
	private $uteisSQL = NULL;


	/*=====================================================================
	   METODO CONSTRUCT PARA A INTERFACE E DESTRUCT
	=====================================================================*/

	public function interfaceM50(){
		$this->funcoes = new funcoes();
		$this->uteisSQL = new uteisMysql();
		$this->daoCli = new clienteDao();
		$this->daoPed = new pedidoDao();

		$this->siglaOper = "M50";
		$this->siglaFile = "E";
		$this->workDate = date("Ymd");
		$this->workHour = date("H");
		$this->workTime = date("YmdHis");
		$this->pathSistema = getcwd();
		
		$this->dirOrigem = $this->pathSistema."\\".$this->siglaOper;
		//$this->dirDestino = $this->pathSistema."outgoing\\infolog\\MXX";
		$this->dirProcessados = $this->pathSistema."\\".$this->siglaOper."\\processados\\".$this->workDate."\\".$this->workHour;
		$this->dirTratamento = $this->pathSistema."\\".$this->siglaOper."\\".$this->workTime;

		$this->geraDirs();

		$this->pesquisaArquivo();

		$this->delDirTratamento();
	}

	function __destruct(){}


	/*=====================================================================
	   METODO DE CRIACAO DAS PASTAS PROCESSADOS E TRATAMENTO
	=====================================================================*/

	private function geraDirs(){
		$dirDate = $this->siglaOper."/processados/".$this->workDate;
		if (! is_dir($dirDate)){
			mkdir ($dirDate) or die ();
		}
		$dirHour = $this->siglaOper. "/processados/".$this->workDate."/".$this->workHour;
		if (! is_dir($dirHour)){
			mkdir ($dirHour);
		}
		$dirTime = $this->siglaOper."/".$this->workTime;
		if (! is_dir($dirTime)){
			mkdir ($dirTime);
		}
	}


	/*=====================================================================
	   METODO DE DELECAO DA PASTA DE TRATAMENTO
	=====================================================================*/

	private function delDirTratamento(){
		rmdir($this->dirTratamento) or die();
	}


	/*=====================================================================
	   METODO PARA PESQUISA DOS ARQUIVOS QUE SERAO TRATADOS
	=====================================================================*/

	private function pesquisaArquivo($filtro="",$nivel=""){
		$dir = $this->dirOrigem;
		$diraberto = opendir($dir);
		chdir($dir);
		//$this->logs->addLog($this->siglaOper,"IN","INICIO",$this->workTime,"Processo - inicio pesquisa");
		$totArquivos = 0;
		while($arq = readdir($diraberto)) {
			if($arq == ".." || $arq == "." || is_dir($arq)) continue;
			$arr_ext = explode(";",$filtro);
			foreach($arr_ext as $ext) {

				$extpos = (strtolower(substr($arq,strlen($arq)-strlen($ext)))) == strtolower($ext);
				
				if ($extpos == strlen($arq) and is_file($arq)){
					$this->copyProcessadoWork($arq);
					$this->trataArquivo($arq);

				//	$this->moveWorkOutgoing($arq);
				}

			}
			$totArquivos++;
		}
		//chdir("..");
		//closedir($diraberto);
		//$this->logs->addLog($this->siglaOper,"IN","FIM",$this->workTime,"Processo - fim: ".$totArquivos." arqs");
	}


	/*=====================================================================
	   METODO PARA COPIA DO ARQUIVO PARA PROCESSADOS E PARA O TRATAMENTO
	=====================================================================*/

	private function copyProcessadoWork($arq){
		//$this->replaceArquivo($arq);
		
		
		copy($arq, $this->dirProcessados."\\".$arq);
		copy($arq, $this->dirTratamento."\\".$arq);
		$this->replaceArquivo($arq);
		unlink($arq);
		//$this->logs->addLog($this->siglaOper,"IN",$arq,$this->workTime,"Copiado: processados, tratamento");
	}


	/*=====================================================================
	   METODO PARA RETIRAR SUJEIRAS DOS ARQUIVOS XML
	=====================================================================*/

	private function replaceArquivo($arq){
		$linhas = file($arq);
		$newLine = NULL;
		foreach($linhas as $klinha => $linha){
			$newLine .= str_replace('<?xml version="1.0" encoding="windows-1252"?>', "", $linha);
		}
		echo $newLine . "----------------------<br>";
		$arqNew = fopen($this->dirTratamento."\\".$arq,'w');
		flock($arqNew, LOCK_EX);
		fwrite($arqNew, $newLine);
		fflush($arqNew);
		flock($arqNew, LOCK_UN);
		fclose($arqNew);
	}


	/*=====================================================================
	   METODO PARA TRATAMENTO DE ARQUIVOS
	=====================================================================*/

	private function trataArquivo($arq){
		$xml = simplexml_load_file($this->dirTratamento."\\".$arq) or die("erro");
		$pedidos = array();
		$clientes = array();
		$pedido = NULL; $pedidoNew = NULL; $tipoPessoa = NULL;
		$i = -1;
		
		print_r($xml->LIST_G_LIST_CONF);
		
		foreach($xml->LIST_G_LIST_CONF->G_LIST_CONF AS $row){
			$i++;
			$pedido = strval($row->NR_PEDIDO);
			$cliente = $this->funcoes->cleanStr(strval($row->CPF_CNPJ_CLI_ENT));
			$loja = $this->funcoes->cleanStr(strval($row->CNPJ_CPF));
		
			if(!isset($pedido)){
				$pedido = strval($row->NR_PEDIDO);
				$pedidoNew = strval($row->NR_PEDIDO);
			}
			if($pedido != $pedidoNew){
				$pedido = strval($row->NR_PEDIDO);
			}

			if(strlen($cliente) == 11){
				$tipoPessoa = "F";
			}else{
				$tipoPessoa = "J";
			}
			
			$clientes[$cliente]["datcli"] = date("Ymd");
			$clientes[$cliente]["cpfcli"] = $cliente;
			$clientes[$cliente]["nomcli"] = utf8_encode(trim(strval($row->CLIENTE_ENT)));
			
			
			$pedidos[$pedido]["endent"] = utf8_encode($row->ENDERECO_ENT);
			$pedidos[$pedido]["baient"] = utf8_encode($row->BAIRRO_ENT);
			$pedidos[$pedido]["coment"] = utf8_encode(trim(strval(utf8_decode($row->COMPLEMENTO_ENT))));
			$pedidos[$pedido]["cepent"] = $this->funcoes->cleanStr(strval($row->CEP_ENT));
			$pedidos[$pedido]["cident"] = utf8_encode(trim(strval($row->CIDADE_ENT)));
			$pedidos[$pedido]["estent"] = utf8_encode(trim(strval($row->ESTADO_ENT)));
			
			$pedidos[$pedido]["refped"] = strval($row->NR_PEDIDO)."*".strval($row->DISTRIBUICAO)."*".strval($row->PERCURSO);
			$hoje = date("Y")."//".date("m")."//".date("d");
			$pedidos[$pedido]["datped"] = $hoje." ".date("H:m:s");
			$pedidos[$pedido]["difped"] = utf8_encode(strval(utf8_decode($row->INSTRUCOES_ENTREGA)));
			$pedidos[$pedido]["refcli"] = $cliente;
			$pedidos[$pedido]["arqped"] = "processados\\\\".$this->workDate."\\\\".$this->workHour."\\\\".$arq;
			$pedidos[$pedido]["estped"] = utf8_encode("1");
			
			$pedidos[$pedido]["item"][$i]["codpro"] = trim(strval($row->COD_PRODUTO));
			$pedidos[$pedido]["item"][$i]["dscpro"] = trim(strval($row->DES_PRODUTO));
			$pedidos[$pedido]["item"][$i]["lotpro"] = strval($row->COD_TONAL_CALIBRE);
			$pedidos[$pedido]["item"][$i]["unipro"] = strtoupper(strval($row->UNIDADE_MEDIDA));
			$pedidos[$pedido]["item"][$i]["qtdsol"] = floatval($row->QDE_SOLIC);
			$pedidos[$pedido]["item"][$i]["palsol"] = floatval($row->QT_PALLET);
			$pedidos[$pedido]["item"][$i]["cxssol"] = floatval($row->QT_CAIXA);
			
			$pedidoNew = strval($row->NR_PEDIDO);
		}
		foreach($clientes AS $cliente){
			$this->daoCli->inserir($cliente);
		}
		
		foreach($pedidos AS $pedido){
			$this->daoPed->inserir($pedido);
		}

		unlink($this->dirTratamento."\\".$arq);
		//$this->logs->addLog($this->siglaOper,"IN",$arq,$this->workTime,"Tratado");
}

	/*=====================================================================
	   METODO PARA ENVIO DOS ARQUIVOS TRATADOS PARA A PASTA OUTGOING
	=====================================================================*/

	private function moveWorkOutgoing($arq){
		sleep(1);
		$narq = $this->siglaFile . $this->funcoes->giveName();
		copy($this->dirTratamento."\\".$arq, $this->dirDestino."\\".$narq);
		unlink($this->dirTratamento."\\".$arq);
		//$this->logs->addLog($this->siglaOper,"IN",$arq,$this->workTime,"Enviado para outgoing: ".$narq);
	}


}


/*=====================================================================
   RODA INTERFACE
=====================================================================*/
echo "Iniciou em: ".date("Y-m-d - H:i:s")."\n";
$inter = new interfaceM50();
echo "Interface executada com sucesso.";
unset($inter);
echo "\nFinalizou em: ".date("Y-m-d - H:i:s")."\n";
exit;
?>