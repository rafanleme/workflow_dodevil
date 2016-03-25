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
##*/

class relatorios extends dbConn{

	public $limitRows = NULL;
	public $filterRows = NULL;
	public $fields = NULL;
	public $froms = NULL;
	public $orders = NULL;
	public $createquery = NULL;
	private $myConn = NULL;
	public $totRows = NULL;
	public $erro = NULL;

	function relatorios(){
		$this->myConn = dbConn::dbOpen();
	}

	function DBClose(){
	      	$this->myConn = dbConn::dbClose();
	}

	function __destruct(){
	      	$this->myConn = dbConn::dbClose();
	}

	public function relFull(){
		$this->fields = empty($this->fields) ? "*" : $this->fields;
		$this->filterRows = empty($this->filterRows) ? " WHERE 1=1 " : " WHERE 1=1 ".$this->filterRows;
		$this->orders = empty($this->orders) ? " " : " ORDER BY ".$this->orders;
		$query_rel = "SELECT ".$this->fields." FROM ".$this->froms." ".$this->filterRows." ".$this->orders." ".$this->limitRows." ";
		$myRes = $this->myConn->prepare($query_rel);
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

	public function relCreateQuery(){
		$query_rel = $this->createquery.$this->limitRows." ";
		$myRes = $this->myConn->prepare($query_rel);
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

	public function kpiTempoPermanencia($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_entrada_portaria,'%d/%m/%Y') AS DATA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_entrada_portaria)))) AS CHAR),':',1) AS tempo_permanencia
				FROM cad_controle_transito
				WHERE cct_status = 3 AND DATE_FORMAT(cct_hora_entrada_portaria,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_entrada_portaria,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cct_hora_entrada_portaria,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cct_hora_entrada_portaria,7) AS SEMANA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_entrada_portaria)))) AS CHAR),':',1) AS tempo_permanencia
				FROM cad_controle_transito
				WHERE cct_status = 3 AND WEEK(cct_hora_entrada_portaria,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cct_hora_entrada_portaria,7)
				ORDER BY WEEK(cct_hora_entrada_portaria,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_entrada_portaria,'%m/%Y') AS MES,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_entrada_portaria)))) AS CHAR),':',1) AS tempo_permanencia
				FROM cad_controle_transito
				WHERE cct_status = 3 AND DATE_FORMAT(cct_hora_entrada_portaria,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_entrada_portaria,'%Y-%m')
				ORDER BY DATE_FORMAT(cct_hora_entrada_portaria,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cct_hora_entrada_portaria) AS ANO,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_entrada_portaria)))) AS CHAR),':',1) AS tempo_permanencia
				FROM cad_controle_transito
				WHERE cct_status = 3 AND YEAR(cct_hora_entrada_portaria) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cct_hora_entrada_portaria)
				ORDER BY YEAR(cct_hora_entrada_portaria)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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

	public function kpiTempoCargaDescarga($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_doca,'%d/%m/%Y') AS DATA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_doca,cct_hora_entrada_doca)))) AS CHAR),':',1) AS tempo_cargadescarga
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_doca,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_doca,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cct_hora_saida_doca,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cct_hora_saida_doca,7) AS SEMANA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_doca,cct_hora_entrada_doca)))) AS CHAR),':',1) AS tempo_cargadescarga
				FROM cad_controle_transito
				WHERE WEEK(cct_hora_saida_doca,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cct_hora_saida_doca,7)
				ORDER BY WEEK(cct_hora_saida_doca,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_doca,'%m/%Y') AS MES,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_doca,cct_hora_entrada_doca)))) AS CHAR),':',1) AS tempo_cargadescarga
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_doca,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_doca,'%Y-%m')
				ORDER BY DATE_FORMAT(cct_hora_saida_doca,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cct_hora_saida_doca) AS ANO,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_doca,cct_hora_entrada_doca)))) AS CHAR),':',1) AS tempo_cargadescarga
				FROM cad_controle_transito
				WHERE YEAR(cct_hora_saida_doca) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cct_hora_saida_doca)
				ORDER BY YEAR(cct_hora_saida_doca)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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

	public function kpiTempoEsperaCarregamento($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_espera,'%d/%m/%Y') AS DATA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cct_hora_saida_espera,7) AS SEMANA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE WEEK(cct_hora_saida_espera,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cct_hora_saida_espera,7)
				ORDER BY WEEK(cct_hora_saida_espera,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_espera,'%m/%Y') AS MES,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m')
				ORDER BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cct_hora_saida_espera) AS ANO,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE YEAR(cct_hora_saida_espera) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cct_hora_saida_espera)
				ORDER BY YEAR(cct_hora_saida_espera)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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

	public function kpiTempoEsperaSairCD($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_portaria,'%d/%m/%Y') AS DATA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_saida_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_portaria,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_portaria,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cct_hora_saida_portaria,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cct_hora_saida_portaria,7) AS SEMANA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_saida_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE WEEK(cct_hora_saida_portaria,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cct_hora_saida_portaria,7)
				ORDER BY WEEK(cct_hora_saida_portaria,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_portaria,'%m/%Y') AS MES,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_saida_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_portaria,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_portaria,'%Y-%m')
				ORDER BY DATE_FORMAT(cct_hora_saida_portaria,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cct_hora_saida_portaria) AS ANO,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_portaria,cct_hora_saida_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE YEAR(cct_hora_saida_portaria) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cct_hora_saida_portaria)
				ORDER BY YEAR(cct_hora_saida_portaria)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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

	public function kpiTempoEsperaPatio($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_espera,'%d/%m/%Y') AS DATA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cct_hora_saida_espera,7) AS SEMANA,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE WEEK(cct_hora_saida_espera,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cct_hora_saida_espera,7)
				ORDER BY WEEK(cct_hora_saida_espera,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cct_hora_saida_espera,'%m/%Y') AS MES,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE DATE_FORMAT(cct_hora_saida_espera,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m')
				ORDER BY DATE_FORMAT(cct_hora_saida_espera,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cct_hora_saida_espera) AS ANO,
					SUBSTRING_INDEX(CAST(SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(cct_hora_saida_espera,cct_hora_entrada_espera)))) AS CHAR),':',1) AS tempo_espera
				FROM cad_controle_transito
				WHERE YEAR(cct_hora_saida_espera) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cct_hora_saida_espera)
				ORDER BY YEAR(cct_hora_saida_espera)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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

	public function kpiQtdInOutVisitantes($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cmo_data_saida,'%d/%m/%Y') AS DATA,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo = 1 AND cmo_status = 2 AND 
					DATE_FORMAT(cmo_data_saida,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cmo_data_saida,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cmo_data_saida,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cmo_data_saida,7) AS SEMANA,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo = 1 AND cmo_status = 2 AND 
					WEEK(cmo_data_saida,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cmo_data_saida,7)
				ORDER BY WEEK(cmo_data_saida,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cmo_data_saida,'%m/%Y') AS MES,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo = 1 AND cmo_status = 2 AND 
					DATE_FORMAT(cmo_data_saida,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cmo_data_saida,'%Y-%m')
				ORDER BY DATE_FORMAT(cmo_data_saida,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cmo_data_saida) AS ANO,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo = 1 AND cmo_status = 2 AND 
					YEAR(cmo_data_saida) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cmo_data_saida)
				ORDER BY YEAR(cmo_data_saida)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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

	public function kpiQtdInOutFunTer($p, $di, $do, $n){
		if($p == "diario"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cmo_data_saida,'%d/%m/%Y') AS DATA,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo IN('2','3') AND cmo_status = 2 AND 
					DATE_FORMAT(cmo_data_saida,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cmo_data_saida,'%Y-%m-%d')
				ORDER BY DATE_FORMAT(cmo_data_saida,'%Y-%m-%d')";
		}else if($p == "semanal"){
			$query_kpi = "SELECT 
					WEEK(cmo_data_saida,7) AS SEMANA,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo IN('2','3') AND cmo_status = 2 AND 
					WEEK(cmo_data_saida,7) BETWEEN '".$di."' AND '".$do."'
				GROUP BY WEEK(cmo_data_saida,7)
				ORDER BY WEEK(cmo_data_saida,7)";
		}else if($p == "mensal"){
			$query_kpi = "SELECT 
					DATE_FORMAT(cmo_data_saida,'%m/%Y') AS MES,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo IN('2','3') AND cmo_status = 2 AND 
					DATE_FORMAT(cmo_data_saida,'%Y-%m-%d') BETWEEN '".$di."' AND '".$do."'
				GROUP BY DATE_FORMAT(cmo_data_saida,'%Y-%m')
				ORDER BY DATE_FORMAT(cmo_data_saida,'%Y-%m')";
		}else if($p == "anual"){
			$query_kpi = "SELECT 
					YEAR(cmo_data_saida) AS ANO,
					COUNT(*) AS quantidade
				FROM cad_movimento
				WHERE cmo_tipo IN('2','3') AND cmo_status = 2 AND 
					YEAR(cmo_data_saida) BETWEEN '".$di."' AND '".$do."'
				GROUP BY YEAR(cmo_data_saida)
				ORDER BY YEAR(cmo_data_saida)";
		}
		$myRes = $this->myConn->prepare($query_kpi);
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


}

?>