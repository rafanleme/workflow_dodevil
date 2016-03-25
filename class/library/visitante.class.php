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

class visitante extends dbConn{ 

	public $cvi_id = NULL;
	public $cvi_nome = NULL;
	public $cvi_rg = NULL;
	public $cvi_cpf = NULL;
	public $cvi_ce_id = NULL;
	public $cvi_obs = NULL;
	public $cvi_status = NULL;
	public $cvi_telefone = NULL;
	public $cvi_matricula = NULL;
	public $cvi_depto = NULL;
	public $cvi_tipo = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function visitante(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_visitante = "SELECT * FROM cad_visitante WHERE 1=1 ".$this->filterRows." ORDER BY cvi_nome ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_visitante); 
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
		$query_visitante = "SELECT * FROM cad_visitante WHERE cvi_id=?"; 
		$myRes = $this->myConn->prepare($query_visitante); 
		$myRes->bindParam(1, $this->cvi_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cvi_id = $myVal[0]["cvi_id"]; 
			$this->cvi_nome = $myVal[0]["cvi_nome"]; 
			$this->cvi_rg = $myVal[0]["cvi_rg"]; 
			$this->cvi_cpf = $myVal[0]["cvi_cpf"]; 
			$this->cvi_ce_id = $myVal[0]["cvi_ce_id"]; 
			$this->cvi_obs = $myVal[0]["cvi_obs"]; 
			$this->cvi_status = $myVal[0]["cvi_status"]; 
			$this->cvi_telefone = $myVal[0]["cvi_telefone"]; 
			$this->cvi_matricula = $myVal[0]["cvi_matricula"]; 
			$this->cvi_depto = $myVal[0]["cvi_depto"]; 
			$this->cvi_tipo = $myVal[0]["cvi_tipo"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function getCadByRG(){
		$query_visitante = "SELECT * FROM cad_visitante WHERE cvi_rg=?"; 
		$myRes = $this->myConn->prepare($query_visitante); 
		$myRes->bindParam(1, $this->cvi_rg); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cvi_id = $myVal[0]["cvi_id"]; 
			$this->cvi_nome = $myVal[0]["cvi_nome"]; 
			$this->cvi_rg = $myVal[0]["cvi_rg"]; 
			$this->cvi_cpf = $myVal[0]["cvi_cpf"]; 
			$this->cvi_ce_id = $myVal[0]["cvi_ce_id"]; 
			$this->cvi_obs = $myVal[0]["cvi_obs"]; 
			$this->cvi_status = $myVal[0]["cvi_status"]; 
			$this->cvi_telefone = $myVal[0]["cvi_telefone"]; 
			$this->cvi_matricula = $myVal[0]["cvi_matricula"]; 
			$this->cvi_depto = $myVal[0]["cvi_depto"]; 
			$this->cvi_tipo = $myVal[0]["cvi_tipo"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_visitante = "UPDATE cad_visitante SET cvi_nome=?, cvi_rg=?, cvi_cpf=?, cvi_ce_id=?, cvi_obs=?, cvi_status=?, cvi_telefone=?, cvi_matricula=?, cvi_depto=?, cvi_tipo=? WHERE cvi_id=?"; 
		$myRes = $this->myConn->prepare($query_visitante); 
		$myRes->bindParam(1, $this->cvi_nome); 
		$myRes->bindParam(2, $this->cvi_rg); 
		$myRes->bindParam(3, $this->cvi_cpf); 
		$myRes->bindParam(4, $this->cvi_ce_id); 
		$myRes->bindParam(5, $this->cvi_obs); 
		$myRes->bindParam(6, $this->cvi_status); 
		$myRes->bindParam(7, $this->cvi_telefone); 
		$myRes->bindParam(8, $this->cvi_matricula); 
		$myRes->bindParam(9, $this->cvi_depto); 
		$myRes->bindParam(10, $this->cvi_tipo);
		$myRes->bindParam(11, $this->cvi_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_visitante = "INSERT INTO cad_visitante (cvi_nome, cvi_rg, cvi_cpf, cvi_ce_id, cvi_obs, cvi_status, cvi_telefone, cvi_matricula, cvi_depto, cvi_tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
		$myRes = $this->myConn->prepare($query_visitante); 
		$myRes->bindParam(1, $this->cvi_nome); 
		$myRes->bindParam(2, $this->cvi_rg); 
		$myRes->bindParam(3, $this->cvi_cpf); 
		$myRes->bindParam(4, $this->cvi_ce_id); 
		$myRes->bindParam(5, $this->cvi_obs); 
		$myRes->bindParam(6, $this->cvi_status); 
		$myRes->bindParam(7, $this->cvi_telefone); 
		$myRes->bindParam(8, $this->cvi_matricula); 
		$myRes->bindParam(9, $this->cvi_depto); 
		$myRes->bindParam(10, $this->cvi_tipo);
		if ($myRes->execute()){ 
			$this->cvi_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_visitante = "DELETE FROM cad_visitante WHERE cvi_id=?"; 
		$myRes = $this->myConn->prepare($query_visitante); 
		$myRes->bindParam(1, $this->cvi_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>