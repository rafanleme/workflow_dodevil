<?
/*#######################################################################
#............INFORMACAO.SOBRE.O.DESENVOLVIMENTO.E.A.CRIACAO.............#
#########################################################################
#.............................. Analista:....Juliano Muniz..............#
#.................................E-mail:....juliano.muniz@uol.com.br...#
#................................Celular:....(11) 8611-8004.............#
#.......................................................................#
#.............................. Analista:....Marcelo Queiroz............#
#.................................E-mail:....mqvida@yahoo.com.br........#
#................................Celular:....(11) 7288-3151.............#
#.......................................................................#
#.."BEM-AVENTURADO aquele que teme ao Senhor e anda nos seus caminhos...#
#..Pois comeras do trabalho das tuas maos; feliz seras, e te ira bem."..#
#...........................................* Salmo 128:1-2.............#
#######################################################################*/

class data extends dbConn{ 

	public $cdt_id = NULL;
	public $cdt_descricao = NULL;
	public $cdt_data = NULL;
	public $cdt_cs_id = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function data(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_data = "SELECT * FROM cad_datas WHERE 1=1 ".$this->filterRows." ORDER BY cdt_data ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_data); 
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
		$query_data = "SELECT * FROM cad_datas WHERE cdt_id=?"; 
		$myRes = $this->myConn->prepare($query_data); 
		$myRes->bindParam(1, $this->cdt_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cdt_id = $myVal[0]["cdt_id"]; 
			$this->cdt_descricao = $myVal[0]["cdt_descricao"]; 
			$this->cdt_data = $myVal[0]["cdt_data"]; 
			$this->cdt_cs_id = $myVal[0]["cdt_cs_id"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_data = "UPDATE cad_datas SET cdt_descricao=?, cdt_data=?, cdt_cs_id=? WHERE cdt_id=?"; 
		$myRes = $this->myConn->prepare($query_data); 
		$myRes->bindParam(1, $this->cdt_descricao); 
		$myRes->bindParam(2, $this->cdt_data); 
		$myRes->bindParam(3, $this->cdt_cs_id); 
		$myRes->bindParam(4, $this->cdt_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_data = "INSERT INTO cad_datas (cdt_descricao, cdt_data, cdt_cs_id) VALUES (?, ?, ?)"; 
		$myRes = $this->myConn->prepare($query_data); 
		$myRes->bindParam(1, $this->cdt_descricao); 
		$myRes->bindParam(2, $this->cdt_data); 
		$myRes->bindParam(3, $this->cdt_cs_id); 
		if ($myRes->execute()){ 
			$this->cdt_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_data = "DELETE FROM cad_datas WHERE cdt_id=?"; 
		$myRes = $this->myConn->prepare($query_data); 
		$myRes->bindParam(1, $this->cdt_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>