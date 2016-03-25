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

class grafico extends dbConn{ 

	public $gk_id = NULL;
	public $gk_swf = NULL;
	public $gk_init = NULL;
	public $gk_end = NULL;
	public $gk_tipo = NULL;
	public $gk_titulo = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function grafico(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_grafico = "SELECT * FROM kpi_grafico WHERE 1=1 ".$this->filterRows." ORDER BY gk_titulo ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_grafico); 
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
		$query_grafico = "SELECT * FROM kpi_grafico WHERE gk_id=?"; 
		$myRes = $this->myConn->prepare($query_grafico); 
		$myRes->bindParam(1, $this->gk_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->gk_id = $myVal[0]["gk_id"]; 
			$this->gk_swf = $myVal[0]["gk_swf"]; 
			$this->gk_init = $myVal[0]["gk_init"]; 
			$this->gk_end = $myVal[0]["gk_end"]; 
			$this->gk_tipo = $myVal[0]["gk_tipo"]; 
			$this->gk_titulo = $myVal[0]["gk_titulo"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_grafico = "UPDATE kpi_grafico SET gk_swf=?, gk_init=?, gk_end=?, gk_tipo=?, gk_titulo=? WHERE gk_id=?"; 
		$myRes = $this->myConn->prepare($query_grafico); 
		$myRes->bindParam(1, $this->gk_swf); 
		$myRes->bindParam(2, $this->gk_init); 
		$myRes->bindParam(3, $this->gk_end); 
		$myRes->bindParam(4, $this->gk_tipo); 
		$myRes->bindParam(5, $this->gk_titulo); 
		$myRes->bindParam(6, $this->gk_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_grafico = "INSERT INTO kpi_grafico (gk_swf, gk_init, gk_end, gk_tipo, gk_titulo) VALUES (?, ?, ?, ?, ?)"; 
		$myRes = $this->myConn->prepare($query_grafico); 
		$myRes->bindParam(1, $this->gk_swf); 
		$myRes->bindParam(2, $this->gk_init); 
		$myRes->bindParam(3, $this->gk_end); 
		$myRes->bindParam(4, $this->gk_tipo); 
		$myRes->bindParam(5, $this->gk_titulo); 
		if ($myRes->execute()){ 
			$this->gk_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_grafico = "DELETE FROM kpi_grafico WHERE gk_id=?"; 
		$myRes = $this->myConn->prepare($query_grafico); 
		$myRes->bindParam(1, $this->gk_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>