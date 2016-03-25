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

class conferencia extends dbConn{ 

	public $ccf_id = NULL;
	public $ccf_data = NULL;
	public $ccf_supdan = NULL;
	public $ccf_cp_id = NULL;
	public $ccf_cc_id = NULL;
	public $ccf_tara = NULL;
	public $ccf_item = NULL;
	public $ccf_peso_caixa = NULL;
	public $ccf_peso_teorico = NULL;
	public $ccf_peso_liquido = NULL;
	public $ccf_viagem = NULL;
	public $ccf_onda = NULL;
	public $ccf_pedido = NULL;
	public $ccf_cliente = NULL;
	public $ccf_frota = NULL;
	public $ccf_nro_palete1 = NULL;
	public $ccf_nro_palete2 = NULL;
	public $ccf_caixa = NULL;
	public $ccf_resultado = NULL;
	public $ccf_tipo_palete = NULL;
	public $ccf_su_id = NULL;
	public $ccf_reconferido = NULL;
	public $limitRows = NULL;
	public $filterRows = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function conferencia(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function lstCad(){
		$query_conferencia = "SELECT * FROM cad_conferencia WHERE 1=1 ".$this->filterRows." ORDER BY ccf_data DESC ".$this->limitRows." "; 
		$myRes = $this->myConn->prepare($query_conferencia); 
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
		$query_conferencia = "SELECT * FROM cad_conferencia WHERE ccf_id=?"; 
		$myRes = $this->myConn->prepare($query_conferencia); 
		$myRes->bindParam(1, $this->ccf_id); 
		$myRes->execute(); 
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH); 
		$this->totRows = count($myVal); 
		if ($this->totRows>0){ 
			$this->erro = false; 
			$this->ccf_id = $myVal[0]["ccf_id"]; 
			$this->ccf_data = $myVal[0]["ccf_data"]; 
			$this->ccf_supdan = $myVal[0]["ccf_supdan"]; 
			$this->ccf_cp_id = $myVal[0]["ccf_cp_id"]; 
			$this->ccf_cc_id = $myVal[0]["ccf_cc_id"]; 
			$this->ccf_tara = $myVal[0]["ccf_tara"]; 
			$this->ccf_item = $myVal[0]["ccf_item"]; 
			$this->ccf_peso_caixa = $myVal[0]["ccf_peso_caixa"]; 
			$this->ccf_peso_teorico = $myVal[0]["ccf_peso_teorico"]; 
			$this->ccf_peso_liquido = $myVal[0]["ccf_peso_liquido"]; 
			$this->ccf_viagem = $myVal[0]["ccf_viagem"]; 
			$this->ccf_onda = $myVal[0]["ccf_onda"]; 
			$this->ccf_pedido = $myVal[0]["ccf_pedido"]; 
			$this->ccf_cliente = $myVal[0]["ccf_cliente"]; 
			$this->ccf_frota = $myVal[0]["ccf_frota"]; 
			$this->ccf_nro_palete1 = $myVal[0]["ccf_nro_palete1"]; 
			$this->ccf_nro_palete2 = $myVal[0]["ccf_nro_palete2"]; 
			$this->ccf_caixa = $myVal[0]["ccf_caixa"]; 
			$this->ccf_resultado = $myVal[0]["ccf_resultado"]; 
			$this->ccf_tipo_palete = $myVal[0]["ccf_tipo_palete"]; 
			$this->ccf_su_id = $myVal[0]["ccf_su_id"]; 
			$this->ccf_reconferido = $myVal[0]["ccf_reconferido"];
			return $myVal[0]; 
		} else { 
			$this->erro = true; 
			return "<font color=red><b>Erro:</b> Nenhum registro encontrado.</font>"; 
  		} 
		$myVal = NULL; 
		$myRes = NULL; 
	} 

	public function setCad(){
		$query_conferencia = "UPDATE cad_conferencia SET ccf_data=?, ccf_supdan=?, ccf_cp_id=?, ccf_cc_id=?, ccf_tara=?, ccf_item=?, ccf_peso_caixa=?, ccf_peso_teorico=?, ccf_peso_liquido=?, ccf_viagem=?, ccf_onda=?, ccf_pedido=?, ccf_cliente=?, ccf_frota=?, ccf_nro_palete1=?, ccf_nro_palete2=?, ccf_caixa=?, ccf_resultado=?, ccf_tipo_palete=?, ccf_su_id=?, ccf_reconferido=? WHERE ccf_id=?"; 
		$myRes = $this->myConn->prepare($query_conferencia); 
		$myRes->bindParam(1, $this->ccf_data); 
		$myRes->bindParam(2, $this->ccf_supdan); 
		$myRes->bindParam(3, $this->ccf_cp_id); 
		$myRes->bindParam(4, $this->ccf_cc_id); 
		$myRes->bindParam(5, $this->ccf_tara); 
		$myRes->bindParam(6, $this->ccf_item); 
		$myRes->bindParam(7, $this->ccf_peso_caixa); 
		$myRes->bindParam(8, $this->ccf_peso_teorico); 
		$myRes->bindParam(9, $this->ccf_peso_liquido); 
		$myRes->bindParam(10, $this->ccf_viagem); 
		$myRes->bindParam(11, $this->ccf_onda); 
		$myRes->bindParam(12, $this->ccf_pedido); 
		$myRes->bindParam(13, $this->ccf_cliente); 
		$myRes->bindParam(14, $this->ccf_frota); 
		$myRes->bindParam(15, $this->ccf_nro_palete1); 
		$myRes->bindParam(16, $this->ccf_nro_palete2); 
		$myRes->bindParam(17, $this->ccf_caixa); 
		$myRes->bindParam(18, $this->ccf_resultado); 
		$myRes->bindParam(19, $this->ccf_tipo_palete); 
		$myRes->bindParam(20, $this->ccf_su_id); 
		$myRes->bindParam(21, $this->ccf_reconferido); 
		$myRes->bindParam(22, $this->ccf_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function addCad(){ 
		$query_conferencia = "INSERT INTO cad_conferencia (ccf_data, ccf_supdan, ccf_cp_id, ccf_cc_id, ccf_tara, ccf_item, ccf_peso_caixa, ccf_peso_teorico, ccf_peso_liquido, ccf_viagem, ccf_onda, ccf_pedido, ccf_cliente, ccf_frota, ccf_nro_palete1, ccf_nro_palete2, ccf_caixa, ccf_resultado, ccf_tipo_palete, ccf_su_id, ccf_reconferido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
		$myRes = $this->myConn->prepare($query_conferencia); 
		$myRes->bindParam(1, $this->ccf_data); 
		$myRes->bindParam(2, $this->ccf_supdan); 
		$myRes->bindParam(3, $this->ccf_cp_id); 
		$myRes->bindParam(4, $this->ccf_cc_id); 
		$myRes->bindParam(5, $this->ccf_tara); 
		$myRes->bindParam(6, $this->ccf_item); 
		$myRes->bindParam(7, $this->ccf_peso_caixa); 
		$myRes->bindParam(8, $this->ccf_peso_teorico); 
		$myRes->bindParam(9, $this->ccf_peso_liquido); 
		$myRes->bindParam(10, $this->ccf_viagem); 
		$myRes->bindParam(11, $this->ccf_onda); 
		$myRes->bindParam(12, $this->ccf_pedido); 
		$myRes->bindParam(13, $this->ccf_cliente); 
		$myRes->bindParam(14, $this->ccf_frota); 
		$myRes->bindParam(15, $this->ccf_nro_palete1); 
		$myRes->bindParam(16, $this->ccf_nro_palete2); 
		$myRes->bindParam(17, $this->ccf_caixa); 
		$myRes->bindParam(18, $this->ccf_resultado); 
		$myRes->bindParam(19, $this->ccf_tipo_palete); 
		$myRes->bindParam(20, $this->ccf_su_id); 
		$myRes->bindParam(21, $this->ccf_reconferido); 
		if ($myRes->execute()){ 
			$this->ccf_id = $this->myConn->lastInsertId(); 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

	public function remCad(){ 
		$query_conferencia = "DELETE FROM cad_conferencia WHERE ccf_id=?"; 
		$myRes = $this->myConn->prepare($query_conferencia); 
		$myRes->bindParam(1, $this->ccf_id); 
		if ($myRes->execute()){ 
			$this->erro = false; 
		} else { 
			$this->erro = true; 
		} 
		$myRes = NULL; 
	} 

} 

?>