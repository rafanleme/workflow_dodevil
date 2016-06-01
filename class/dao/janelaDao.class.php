<?
require_once("/../../class/dbConn.class.php");
class janelaDao extends dbConn{

	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;
	//private $uteisSql = NULL;

	function janelaDao(){
		$this->myConn = dbConn::dbOpen();
		//$this->uteisSql = new uteisMysql();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}
	
	public function listaJanelaDiaria(){
		$query_r = "SELECT * FROM cad_janela ";
		$query_r .= " WHERE tipjan = 'Diaria'";
		//echo $query_r;
		$myRes = $this->myConn->prepare($query_r);
		$myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
		$this->totRows = count($myVal);
		if ($this->totRows>0){
			$this->erro = false;
			return $myVal;
		} else {
			$this->erro = true;
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>";
		}
		$myVal = NULL;
		$myRes = NULL;
	}

	public function pedidosJanela($data){
		$dataAnt = date("Y-m-d", strtotime("-1days",strtotime($data)));
		$query_r = "SELECT * FROM cad_pedido cp, cad_cliente cc, cad_estado ce";
		$query_r .= " WHERE cp.refcli = cc.cpfcli";
		$query_r .= " AND ce.codest = cp.estped";
		$query_r .= " AND cp.datped BETWEEN '".$dataAnt." 16:00:00'";
		$query_r .= " AND '".$data." 15:59:00'";
		$query_r .= " ORDER BY cc.nomcli, ROTPED";
		//echo $query_r;
		$myRes = $this->myConn->prepare($query_r);
		$myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
		$this->totRows = count($myVal);
		if ($this->totRows>0){
			$this->erro = false;
			return $myVal;
		} else {
			$this->erro = true;
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>";
		}
		$myVal = NULL;
		$myRes = NULL;
	}
	
	
	
	
	
	public function deletaRegistro($tabela,$condicao){
		if(empty($condicao)) return false;
		$query_cad = "DELETE FROM ".$tabela." WHERE ".$condicao;
		$myRes = $this->myConn->prepare($query_cad);
		if ($myRes->execute()){
			return true;
		} else {
			return false;
		}
		$myRes = NULL;
	}
	
	public function updateRegistro($tabela,$dados,$condicao){
		$valores = "";
		foreach($dados AS $key => $val){
			if(!empty($valores)) $valores .= ", ";
			$valores .= $key."='".$val."' ";
		}
		$query_cad = "UPDATE ".$tabela." SET ".$valores." WHERE ".$condicao;
		$myRes = $this->myConn->prepare($query_cad);
		if ($myRes->execute()){
			return true;
		} else {
			return false;
		}
		$myRes = NULL;
	}
}

?>