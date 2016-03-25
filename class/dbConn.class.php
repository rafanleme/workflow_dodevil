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

class dbConn {

	private $myConn = NULL;
	private $sql_host = "localhost";
	private $sql_database = "etrporju";
	private $sql_user = "root";
	private $sql_pass = "";
	private $sql_type = "mysql";

	public function dbConn(){
	}

	public function dbOpen(){
		try {
			$this->myConn = new PDO($this->sql_type.":host=".$this->sql_host.";dbname=".$this->sql_database,$this->sql_user,$this->sql_pass);
			$this->myConn->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
			$this->myConn->setAttribute(PDO::ERRMODE_EXCEPTION);
			$this->myConn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
			return $this->myConn;
		} catch(PDOException $e){
			print "<font color=red face=verdana size=1><B>Error:</b> ".$e->getMessage()."</font><br/>";
			die();
		}
	}

	public function dbClose(){
		//if ($this->myConn!=NULL){
		//$this->myConn=NULL;
		unset($this->myConn);
		//}
	}

}
?>