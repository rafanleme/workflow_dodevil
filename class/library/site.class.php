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

class site extends dbConn{

	public $cs_id = NULL;
	public $cs_nome = NULL;
	public $cs_codigo = NULL;
	public $cs_localizacao = NULL;
	public $cs_sigla = NULL;
	public $cs_docas = NULL;
	public $cs_capacidade = NULL;
	public $cs_status = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function site(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_site = "SELECT * FROM cad_site WHERE 1=1 ".$this->filterRows." ORDER BY cs_nome ASC ".$this->limitRows." ";
		$myRes = $this->myConn->prepare($query_site);
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
		$query_site = "SELECT * FROM cad_site WHERE cs_id=?";
		$myRes = $this->myConn->prepare($query_site);
		$myRes->bindParam(1, $this->cs_id);
		$myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
		$this->totRows = count($myVal);
		if ($this->totRows>0){
			$this->erro = false;
			$this->cs_id = $myVal[0]["cs_id"];
			$this->cs_nome = $myVal[0]["cs_nome"];
			$this->cs_codigo = $myVal[0]["cs_codigo"];
			$this->cs_localizacao = $myVal[0]["cs_localizacao"];
			$this->cs_sigla = $myVal[0]["cs_sigla"];
			$this->cs_docas = $myVal[0]["cs_docas"];
			$this->cs_capacidade = $myVal[0]["cs_capacidade"];
			$this->cs_status = $myVal[0]["cs_status"];
			return $myVal[0];
		} else {
			$this->erro = true;
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>";
  		}
		$myVal = NULL;
		$myRes = NULL;
	}

	public function setCad(){
		$query_site = "UPDATE cad_site SET cs_nome=?, cs_codigo=?, cs_localizacao=?, cs_sigla=?, cs_docas=?, cs_capacidade=?, cs_status=? WHERE cs_id=?";
		$myRes = $this->myConn->prepare($query_site);
		$myRes->bindParam(1, $this->cs_nome);
		$myRes->bindParam(2, $this->cs_codigo);
		$myRes->bindParam(3, $this->cs_localizacao);
		$myRes->bindParam(4, $this->cs_sigla);
		$myRes->bindParam(5, $this->cs_docas);
		$myRes->bindParam(6, $this->cs_capacidade);
		$myRes->bindParam(7, $this->cs_status);
		$myRes->bindParam(8, $this->cs_id);
		if ($myRes->execute()){
			$this->erro = false;
		} else {
			$this->erro = true;
		}
		$myRes = NULL;
	}

	public function addCad(){
		$query_site = "INSERT INTO cad_site (cs_nome, cs_codigo, cs_localizacao, cs_sigla, cs_docas, cs_capacidade, cs_status) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$myRes = $this->myConn->prepare($query_site);
		$myRes->bindParam(1, $this->cs_nome);
		$myRes->bindParam(2, $this->cs_codigo);
		$myRes->bindParam(3, $this->cs_localizacao);
		$myRes->bindParam(4, $this->cs_sigla);
		$myRes->bindParam(5, $this->cs_docas);
		$myRes->bindParam(6, $this->cs_capacidade);
		$myRes->bindParam(7, $this->cs_status);
		if ($myRes->execute()){
			$this->cs_id = $this->myConn->lastInsertId();
			$this->erro = false;
		} else {
			$this->erro = true;
		}
		$myRes = NULL;
	}

	public function remCad(){
		$query_site = "DELETE FROM cad_site WHERE cs_id=?";
		$myRes = $this->myConn->prepare($query_site);
		$myRes->bindParam(1, $this->cs_id);
		if ($myRes->execute()){
			$this->erro = false;
		} else {
			$this->erro = true;
		}
		$myRes = NULL;
	}

}

?>