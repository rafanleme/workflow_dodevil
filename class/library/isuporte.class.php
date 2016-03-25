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

class isuporte extends dbConn{ 

	public $supdan = NULL;
	public $viagem = NULL;
	public $onda = NULL;
	public $pedido = NULL;
	public $palete1 = NULL;
	public $palete2 = NULL;
	public $caixas = NULL;
	public $itens = NULL;
	public $peso_total = NULL;
	public $peso_caixa_leve = NULL;
	public $cliente = NULL;
	public $frota = NULL;
	public $id = NULL;
	public $data = NULL;
	public $arquivo = NULL;
	public $supdan2 = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;
	public $erroMsg = NULL;

	function isuporte(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_isuporte = "SELECT * FROM infolog_suportes WHERE 1=1 ".$this->filterRows." ORDER BY id ASC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_isuporte); 
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
		$query_isuporte = "SELECT * FROM infolog_suportes WHERE id=?"; 
		$myRes = $this->myConn->prepare($query_isuporte); 
		$myRes->bindParam(1, $this->id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->supdan = $myVal[0]["supdan"]; 
			$this->viagem = $myVal[0]["viagem"]; 
			$this->onda = $myVal[0]["onda"]; 
			$this->pedido = $myVal[0]["pedido"]; 
			$this->palete1 = $myVal[0]["palete1"]; 
			$this->palete2 = $myVal[0]["palete2"]; 
			$this->caixas = $myVal[0]["caixas"]; 
			$this->itens = $myVal[0]["itens"]; 
			$this->peso_total = $myVal[0]["peso_total"]; 
			$this->peso_caixa_leve = $myVal[0]["peso_caixa_leve"]; 
			$this->cliente = $myVal[0]["cliente"]; 
			$this->frota = $myVal[0]["frota"]; 
			$this->id = $myVal[0]["id"]; 
			$this->data = $myVal[0]["data"]; 
			$this->arquivo = $myVal[0]["arquivo"]; 
			$this->supdan2 = $myVal[0]["supdan2"]; 
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_isuporte = "UPDATE infolog_suportes SET supdan=?, viagem=?, onda=?, pedido=?, palete1=?, palete2=?, caixas=?, itens=?, peso_total=?, peso_caixa_leve=?, cliente=?, frota=?, data=?, arquivo=?, supdan2=? WHERE id=?"; 
		$myRes = $this->myConn->prepare($query_isuporte); 
		$myRes->bindParam(1, $this->supdan); 
		$myRes->bindParam(2, $this->viagem); 
		$myRes->bindParam(3, $this->onda); 
		$myRes->bindParam(4, $this->pedido); 
		$myRes->bindParam(5, $this->palete1); 
		$myRes->bindParam(6, $this->palete2); 
		$myRes->bindParam(7, $this->caixas); 
		$myRes->bindParam(8, $this->itens); 
		$myRes->bindParam(9, $this->peso_total); 
		$myRes->bindParam(10, $this->peso_caixa_leve); 
		$myRes->bindParam(11, $this->cliente); 
		$myRes->bindParam(12, $this->frota); 
		$myRes->bindParam(13, $this->data); 
		$myRes->bindParam(14, $this->arquivo); 
		$myRes->bindParam(15, $this->supdan);
		$myRes->bindParam(16, $this->id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_isuporte = "INSERT INTO infolog_suportes (supdan, viagem, onda, pedido, palete1, palete2, caixas, itens, peso_total, peso_caixa_leve, cliente, frota, data, arquivo, supdan2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
		$myRes = $this->myConn->prepare($query_isuporte); 
		$myRes->bindParam(1, $this->supdan); 
		$myRes->bindParam(2, $this->viagem); 
		$myRes->bindParam(3, $this->onda); 
		$myRes->bindParam(4, $this->pedido); 
		$myRes->bindParam(5, $this->palete1); 
		$myRes->bindParam(6, $this->palete2); 
		$myRes->bindParam(7, $this->caixas); 
		$myRes->bindParam(8, $this->itens); 
		$myRes->bindParam(9, $this->peso_total); 
		$myRes->bindParam(10, $this->peso_caixa_leve); 
		$myRes->bindParam(11, $this->cliente); 
		$myRes->bindParam(12, $this->frota); 
		$myRes->bindParam(13, $this->data); 
		$myRes->bindParam(14, $this->arquivo); 
		$myRes->bindParam(15, $this->supdan2); 
		if ($myRes->execute()){ 
			$this->id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->id = 0;
			$this->erro = true; 
			$this->erroMsg = print_r($this->myConn->errorInfo(),true)." ".print_r($myRes->errorInfo(),true);
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_isuporte = "DELETE FROM infolog_suportes WHERE id=?"; 
		$myRes = $this->myConn->prepare($query_isuporte); 
		$myRes->bindParam(1, $this->id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>