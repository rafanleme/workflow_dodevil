<?
/*#######################################################################
#............INFORMACAO.SOBRE.O.DESENVOLVIMENTO.E.A.CRIACAO.............#
#########################################################################
#.............................. Analista:....Juliano Muniz..............#
#.................................E-mail:....juliano.muniz@uol.com.br...#
#................................Celular:....(11) 8611-8004.............#
#.......................................................................#
#.."BEM-AVENTURADO aquele que teme ao Senhor e anda nos seus caminhos...#
#..Pois comeras do trabalho das tuas maos; feliz seras, e te ira bem."..#
#...........................................* Salmo 128:1-2.............#
#######################################################################*/

class itemmysql extends dbConn{

	public $supdan = NULL;
	public $supdan2 = NULL;
	public $viagem = NULL;
	public $onda = NULL;
	public $pedido = NULL;
	public $nr_palete1 = NULL;
	public $nr_palete2 = NULL;
	public $vlr_caixas = NULL;
	public $itens = NULL;
	public $vlr_peso = NULL;
	public $vlr_peso_cx_leve = NULL;
	public $cliente = NULL;
	public $frota= NULL;
	public $dados= NULL;
	private $myConn = NULL;
	public $filterRows = NULL;
	public $orderRows = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function itemmysql(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function getSupdanas400(){
		$query_item = "SELECT * FROM infolog_suportes WHERE supdan2='".$this->supdan."' ORDER BY id DESC LIMIT 0,1";
		$myRes = $this->myConn->prepare($query_item);
		$myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
		$this->totRows = count($myVal);
		if ($this->totRows>0){
			$this->erro = false;
			$this->supdan = $myVal[0]["supdan"];
			$this->supdan2 = $myVal[0]["supdan2"];
			$this->viagem = $this->tiraAcento($myVal[0]["viagem"]);
			$this->onda = $myVal[0]["onda"];
			$this->pedido = $myVal[0]["pedido"];
			$this->nr_palete1 = $myVal[0]["palete1"];
			$this->nr_palete2 = $myVal[0]["palete2"];
			$this->vlr_caixas = $myVal[0]["caixas"];
			$this->itens = $myVal[0]["itens"];
			$this->vlr_peso = $myVal[0]["peso_total"];
			$this->vlr_peso_cx_leve = $myVal[0]["peso_caixa_leve"];
			$this->cliente = $myVal[0]["cliente"];
			$this->frota = $myVal[0]["frota"];
			return "OK";
		} else {
			$this->erro = true;
			return "ERRO";
  		}
		$myVal = NULL;
		$myRes = NULL;
	}

	private function tiraAcento($texto){
		$a = array("/[ÂÀÁÄÃ]/"=>"A","/[âãàáä]/"=>"a","/[ÊÈÉË]/"=>"E","/[êèéë]/"=>"e","/[ÎÍÌÏ]/"=>"I","/[îíìï]/"=>"i","/[ÔÕÒÓÖ]/"=>"O","/[ôõòóö]/"=>"o","/[ÛÙÚÜ]/"=>"U","/[ûúùü]/"=>"u","/ç/"=>"c","/Ç/"=> "C");
		return preg_replace(array_keys($a), array_values($a), $texto);
	}

}

?>
