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

class preparador extends dbConn{ 

	public $cp_id = NULL;
	public $cp_matricula = NULL;
	public $cp_nome = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function preparador(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_preparador = "SELECT * FROM cad_preparador WHERE 1=1 ".$this->filterRows." ORDER BY cp_nome ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_preparador); 
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
		$query_preparador = "SELECT * FROM cad_preparador WHERE cp_id=?"; 
		$myRes = $this->myConn->prepare($query_preparador); 
		$myRes->bindParam(1, $this->cp_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cp_id = $myVal[0]["cp_id"]; 
			$this->cp_matricula = $myVal[0]["cp_matricula"]; 
			$this->cp_nome = $myVal[0]["cp_nome"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_preparador = "UPDATE cad_preparador SET cp_matricula=?, cp_nome=? WHERE cp_id=?"; 
		$myRes = $this->myConn->prepare($query_preparador); 
		$myRes->bindParam(1, $this->cp_matricula); 
		$myRes->bindParam(2, $this->cp_nome); 
		$myRes->bindParam(3, $this->cp_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_preparador = "INSERT INTO cad_preparador (cp_matricula, cp_nome) VALUES (?, ?)"; 
		$myRes = $this->myConn->prepare($query_preparador); 
		$myRes->bindParam(1, $this->cp_matricula); 
		$myRes->bindParam(2, $this->cp_nome); 
		if ($myRes->execute()){ 
			$this->cp_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_preparador = "DELETE FROM cad_preparador WHERE cp_id=?"; 
		$myRes = $this->myConn->prepare($query_preparador); 
		$myRes->bindParam(1, $this->cp_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>