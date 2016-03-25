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
include("../class/db2Conn.class.php");

class getSuporteAS400 extends db2Conn{
	
	/*
	public $supdan = NULL;
	public $viagem = NULL;
	public $onda = NULL;
	public $pedido = NULL;
	public $nr_palete1 = NULL;
	public $nr_palete2 = NULL;
	public $vlr_caixas = NULL;
	public $itens = NULL;
	public $vlr_peso = NULL;
	public $vlr_peso_cx_leve = NULL;
	public $cliente = NULL;
	public $frota= NULL;
	public $dados= NULL;
	*/
	private $myConn = NULL;
	public $filterRows = NULL;
	public $orderRows = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function getSuporteAS400(){
		$this->myConn = db2Conn::db2Open();
	}

	function DBClose(){
	      	$this->myConn = db2Conn::db2Close();
	}

	function __destruct(){
	      	$this->myConn = db2Conn::db2Close();
	}

	public function getSuportesAS400()
	{
		$query_itemas400 = "SELECT T1.NUMSUP,T1.TYPSUP,T2.LIBVAG,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV,T1.DATPRP,
							T1.CUMCOL,T1.ETASUP,T1.CODPRP,T4.NOMPRP
							FROM FGE50AGNIV.GESUPE T1
							LEFT JOIN FGE50AGNIV.GEVAG T2 ON T1.NUMVAG = T2.NUMVAG
							LEFT JOIN FGE50AGNIV.GELIVE T3 ON T1.NUMLIV = T3.NUMLIV
							LEFT JOIN FGE50AGNIV.GEZPRP T4 ON T1.CODPRP = T4.CODPRP								   								   								   
							WHERE T1.TYPSUP IN('1','2') AND T1.NUMSUP > 15071423
							GROUP BY T1.NUMSUP,T1.TYPSUP,T2.LIBVAG,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV,
							T1.DATPRP,T1.CUMCOL,T1.ETASUP,T1.CODPRP,T4.NOMPRP";
   
		$myRes = $this->myConn->prepare($query_itemas400);
		$myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
		$this->totRows = count($myVal);
		if ($this->totRows>0){
			
			print $myVal[0]["NUMSUP"];
			
			/*
			$this->erro = false;
			$this->supdan = $myVal[0]["SUPDAN"];
			$this->viagem = $this->tiraAcento($myVal[0]["VIAGEM"]);
			$this->onda = $myVal[0]["ONDA"];
			$this->pedido = $myVal[0]["PEDIDO"];
			$this->nr_palete1 = $myVal[0]["NR_PALETE1"];
			$this->nr_palete2 = $myVal[0]["NR_PALETE2"];
			$this->vlr_caixas = $myVal[0]["VLR_CAIXAS"];
			$this->itens = $myVal[0]["ITENS"];
			$this->vlr_peso = $myVal[0]["VLR_PESO"];
			$this->vlr_peso_cx_leve = $myVal[0]["VLR_PESO_CX_LEVE"];
			return "OK";
			*/
		} else {
			$this->erro = true;
			return "ERRO";
  		}
		$myVal = NULL;
		$myRes = NULL;
	}
	
	private function tiraAcento($texto){
		$a = array("/[ÂÀÁÄÃ]/"=>"A","/[âãàáä]/"=>"a","/[ÊÈÉË]/"=>"E","/[êèéë]/"=>"e","/[ÎÍÌÏ]/"=>"I","/[îíìï]/"=>"i","/[ÔÕÒÓÖ]/"=>"O","/[ôõòóö]/"=>"o","/[ÛÙÚÜ]/"=>"U","/[ûúùü]/"=>"u","/ç/"=>"c","/Ç/"=> "C");
		return preg_replace(array_keys($a), array_values($a), $texto);
	}

}

?>
