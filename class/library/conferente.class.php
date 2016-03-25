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

class conferente extends dbConn{ 

	public $cc_id = NULL;
	public $cc_matricula = NULL;
	public $cc_nome = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function conferente(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_conferente = "SELECT * FROM cad_conferente WHERE 1=1 ".$this->filterRows." ORDER BY cc_nome ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_conferente); 
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

	public function getCad(){
		$query_conferente = "SELECT * FROM cad_conferente WHERE cc_id=?"; 
		$myRes = $this->myConn->prepare($query_conferente); 
		$myRes->bindParam(1, $this->cc_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cc_id = $myVal[0]["cc_id"]; 
			$this->cc_matricula = $myVal[0]["cc_matricula"]; 
			$this->cc_nome = $myVal[0]["cc_nome"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_conferente = "UPDATE cad_conferente SET cc_matricula=?, cc_nome=? WHERE cc_id=?"; 
		$myRes = $this->myConn->prepare($query_conferente); 
		$myRes->bindParam(1, $this->cc_matricula); 
		$myRes->bindParam(2, $this->cc_nome); 
		$myRes->bindParam(3, $this->cc_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_conferente = "INSERT INTO cad_conferente (cc_matricula, cc_nome) VALUES (?, ?)"; 
		$myRes = $this->myConn->prepare($query_conferente); 
		$myRes->bindParam(1, $this->cc_matricula); 
		$myRes->bindParam(2, $this->cc_nome); 
		if ($myRes->execute()){ 
			$this->cc_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_conferente = "DELETE FROM cad_conferente WHERE cc_id=?"; 
		$myRes = $this->myConn->prepare($query_conferente); 
		$myRes->bindParam(1, $this->cc_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>