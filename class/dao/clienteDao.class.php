<?
require_once("class/uteisMysql.class.php");
class clienteDao extends dbConn{

	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;
	private $uteisSql = NULL;

	function clienteDao(){
		$this->myConn = dbConn::dbOpen();
		$this->uteisSql = new uteisMysql();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function inserir($dados){
		$max = $this->uteisSql->maxId("cad_cliente","codcli");
		$campos = "";
		$valores = "";
		foreach($dados AS $key => $val){
			if(!empty($campos)) $campos .= ", ";
			if(!empty($valores)) $valores .= ", ";
			$campos .= $key;
			$valores .= "'".$val."'";
		}
		$query = "INSERT INTO cad_cliente (".$campos.") VALUES (".$valores.")";
		$myRes = $this->myConn->prepare($query) or die("erro cliente");
		if ($myRes->execute()){
			return true;
		} else {
			return false;
		}
		$myRes = NULL;
	}
	
	public function runQuery($query){
		$query_r = $query;
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

	public function existeRegistro($tabela,$condicao){
		$query = "SELECT * FROM ".$tabela." WHERE ".$condicao;
		$myRes = $this->myConn->prepare($query);
		$myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
		$this->totRows = count($myVal);
		if ($this->totRows>0){
			return true;
		} else {
			return false;
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