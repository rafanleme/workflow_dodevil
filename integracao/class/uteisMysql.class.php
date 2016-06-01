<?
include("../../class/dbConn.class.php");
class uteisMysql extends dbConn{

	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function uteisMysql(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}
	
	public function maxId($tabela,$campo){
		$max = 0;
		$query = "SELECT MAX(".$campo.") as max FROM ".$tabela;
		$myRes = $this->myConn->prepare($query);
		$myRes->execute();
		$linha = $myRes->fetch(PDO::FETCH_ASSOC);
		if($linha["max"] != 0){
			$max = $linha["max"];
		}
		return $max+1;
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

	public function addLog($processo,$mensagem,$natureza){
		$logId = $this->maxId("cad_logs","codlog");
		$hoje = date("Y")."//".date("m")."//".date("d")." ".date("H:m:s");
		$query_cadrecusa = "INSERT INTO cad_logs (codlog,datlog,prolog,menlog,natlog)";
		$query_cadrecusa .= " VALUES (?,now(),?,?,?)";
		//echo $query_cadrecusa."<br><br>";
		$myRes = $this->myConn->prepare($query_cadrecusa);
		$myRes->bindParam(1, $logId);
		$myRes->bindParam(2, $processo);
		$myRes->bindParam(3, $mensagem);
		$myRes->bindParam(4, $natureza);
	
		if ($myRes->execute()){
			$this->cr_id = $this->myConn->lastInsertId();
			$this->erro = false;
		} else {
			$this->erro = true;
		}
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
	
	
	public function insereRegistro($tabela,$dados,$onDuplicate=""){
		$campos = "";
		$valores = "";
		foreach($dados AS $key => $val){
			if(!empty($campos)) $campos .= ", ";
			if(!empty($valores)) $valores .= ", ";
			$campos .= $key;
			$valores .= "'".$val."'";
		}
		$query_cad = "INSERT INTO ".$tabela." (".$campos.") VALUES (".$valores.") ".$onDuplicate.";";
		//echo $query_cad;
		$myRes = $this->myConn->prepare($query_cad);
		if ($myRes->execute()){
			return true;
		} else {
			return false;
		}
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