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

class funcionario extends dbConn{ 

	public $cf_id = NULL;
	public $cf_ce_id = NULL;
	public $cf_nome = NULL;
	public $cf_matricula = NULL;
	public $cf_rg = NULL;
	public $cf_depto = NULL;
	public $cf_obs = NULL;
	public $cf_status = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function funcionario(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_funcionario = "SELECT * FROM cad_funcionarios WHERE 1=1 ".$this->filterRows." ORDER BY cf_nome ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_funcionario); 
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
		$query_funcionario = "SELECT * FROM cad_funcionarios WHERE cf_id=?"; 
		$myRes = $this->myConn->prepare($query_funcionario); 
		$myRes->bindParam(1, $this->cf_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cf_id = $myVal[0]["cf_id"]; 
			$this->cf_ce_id = $myVal[0]["cf_ce_id"]; 
			$this->cf_nome = $myVal[0]["cf_nome"]; 
			$this->cf_matricula = $myVal[0]["cf_matricula"]; 
			$this->cf_rg = $myVal[0]["cf_rg"]; 
			$this->cf_depto = $myVal[0]["cf_depto"]; 
			$this->cf_obs = $myVal[0]["cf_obs"]; 
			$this->cf_status = $myVal[0]["cf_status"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 
	
	public function getCadByRG(){
		$query_funcionario = "SELECT * FROM cad_funcionarios WHERE cf_rg=?"; 
		$myRes = $this->myConn->prepare($query_funcionario); 
		$myRes->bindParam(1, $this->cf_rg); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->cf_id = $myVal[0]["cf_id"]; 
			$this->cf_ce_id = $myVal[0]["cf_ce_id"]; 
			$this->cf_nome = $myVal[0]["cf_nome"]; 
			$this->cf_matricula = $myVal[0]["cf_matricula"]; 
			$this->cf_rg = $myVal[0]["cf_rg"]; 
			$this->cf_depto = $myVal[0]["cf_depto"]; 
			$this->cf_obs = $myVal[0]["cf_obs"]; 
			$this->cf_status = $myVal[0]["cf_status"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_funcionario = "UPDATE cad_funcionarios SET cf_ce_id=?, cf_nome=?, cf_matricula=?, cf_rg=?, cf_depto=?, cf_obs=?, cf_status=? WHERE cf_id=?"; 
		$myRes = $this->myConn->prepare($query_funcionario); 
		$myRes->bindParam(1, $this->cf_ce_id); 
		$myRes->bindParam(2, $this->cf_nome); 
		$myRes->bindParam(3, $this->cf_matricula); 
		$myRes->bindParam(4, $this->cf_rg); 
		$myRes->bindParam(5, $this->cf_depto); 
		$myRes->bindParam(6, $this->cf_obs); 
		$myRes->bindParam(7, $this->cf_status); 
		$myRes->bindParam(8, $this->cf_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_funcionario = "INSERT INTO cad_funcionarios (cf_ce_id, cf_nome, cf_matricula, cf_rg, cf_depto, cf_obs, cf_status) VALUES (?, ?, ?, ?, ?, ?, ?)"; 
		$myRes = $this->myConn->prepare($query_funcionario); 
		$myRes->bindParam(1, $this->cf_ce_id); 
		$myRes->bindParam(2, $this->cf_nome); 
		$myRes->bindParam(3, $this->cf_matricula); 
		$myRes->bindParam(4, $this->cf_rg); 
		$myRes->bindParam(5, $this->cf_depto); 
		$myRes->bindParam(6, $this->cf_obs); 
		$myRes->bindParam(7, $this->cf_status); 
		if ($myRes->execute()){ 
			$this->cf_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_funcionario = "DELETE FROM cad_funcionarios WHERE cf_id=?"; 
		$myRes = $this->myConn->prepare($query_funcionario); 
		$myRes->bindParam(1, $this->cf_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>