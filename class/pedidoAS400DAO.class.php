<?php

require_once("db2Conn.class.php");
class pedidoAS400DAO extends db2Conn
{
	public $BibliotecaAS400 = "FGE50AGPOR";
    public $myConn = NULL;
    public $filterRows = NULL;
    public $orderRows = NULL;
    public $totRows = NULL;
    public $erro = NULL;
    
    function pedidoAS400DAO()
    {
        $this->myConn = db2Conn::db2Open();
    }

    function pedidoAS400DAODBClose()
    {
      	$this->myConn = db2Conn::db2Close();
    }

    function __destruct()
    {
      	$this->myConn = db2Conn::db2Close();
    }
	public function verificaPedidos($pedidos){
		$query = "SELECT NUMLIV as NUMPED,TOULIV as ROTPED, ORDLIV as ORDPED, KAILIV as KAIPED ,REFLIV as REFPED ";
		$query .= "FROM ".$this->BibliotecaAS400.".GELIVE WHERE REFLIV IN (".$pedidos.")";
		$myRes = $this->myConn->prepare($query);
        $myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_ASSOC);
		$this->totRows = count($myVal);
		if ($this->totRows>0)
        {
            $this->erro = false;
            return $myVal;	
        } 
        else 
        {
            $this->erro = true;
            return "ERRO";
	  	}
		$myVal = NULL;
		$myRes = NULL;
	}
	
	/*
    public function getSuporte($numsup)
    {
		set_time_limit(0);
		$query_as400  = "SELECT T3.MSGPRP1,T1.NUMSUP,T2.LIBVAG,T1.NUMVAG,T1.KAILIV,T3.NOMTRA,T1.NOMCLI,T1.DATLIV,T1.DATPRP, ";
		$query_as400 .= "T1.CUMCOL,T1.CUMLIG,T1.ETASUP,T1.CODPRP,T4.NOMPRP,T1.DATSUP1||DIGITS(T1.HEUSUP1) DATSUP1,T1.DATSUP2||DIGITS(T1.HEUSUP2) DATSUP2, ";
		$query_as400 .= "T5.DATHIS || DIGITS(T5.HEUHIS) DATSUP3,T6.DATHIS || DIGITS(T6.HEUHIS) DATSUP4 ";
		$query_as400 .= "FROM ".$this->BibliotecaAS400.".GESUPE T1 ";
		$query_as400 .= "LEFT JOIN ".$this->BibliotecaAS400.".GEVAG T2 ON T1.NUMVAG = T2.NUMVAG ";
		$query_as400 .= "LEFT JOIN ".$this->BibliotecaAS400.".GELIVE T3 ON T1.NUMLIV = T3.NUMLIV ";							   
		$query_as400 .= "LEFT JOIN ".$this->BibliotecaAS400.".GEZPRP T4 ON T1.CODPRP = T4.CODPRP ";
		$query_as400 .= "LEFT JOIN (SELECT NUMSUP,DATHIS,MIN(HEUHIS) HEUHIS FROM ".$this->BibliotecaAS400.".GEHSUP ";
		$query_as400 .= "			WHERE NUMSUP = $numsup AND ETASUP = '20' ";
		$query_as400 .= "			GROUP BY NUMSUP,DATHIS ";
		$query_as400 .= "			ORDER BY DATHIS DESC FETCH FIRST 1 ROWS ONLY) T5 ON T1.NUMSUP = T5.NUMSUP ";
		$query_as400 .= "LEFT JOIN (SELECT NUMSUP,DATHIS,MIN(HEUHIS) HEUHIS FROM ".$this->BibliotecaAS400.".GEHSUP ";
		$query_as400 .= "			WHERE NUMSUP = $numsup AND ETASUP = '30' ";
		$query_as400 .= "			GROUP BY NUMSUP,DATHIS	";		
		$query_as400 .= "			ORDER BY DATHIS ASC FETCH FIRST 1 ROWS ONLY) T6 ON T1.NUMSUP = T6.NUMSUP ";
		$query_as400 .= "WHERE T1.TYPSUP IN('1','2') AND T1.NUMSUP = $numsup AND T1.CUMCOL > 0 ";
		$query_as400 .= "GROUP BY T3.MSGPRP1,T1.NUMSUP,T2.LIBVAG,T1.KAILIV,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV, ";
		$query_as400 .= "T1.DATPRP,T1.CUMCOL,T1.CUMLIG,T1.ETASUP,T1.CODPRP,T4.NOMPRP,T1.DATSUP1||DIGITS(T1.HEUSUP1), ";
		$query_as400 .= "T1.DATSUP2||DIGITS(T1.HEUSUP2),T5.DATHIS ||DIGITS(T5.HEUHIS),T6.DATHIS ||DIGITS(T6.HEUHIS) "; 

        $myRes = $this->myConn->prepare($query_as400);
        $myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_ASSOC);
		$this->totRows = count($myVal);
		if ($this->totRows>0)
        {
            $this->erro = false;
            return $myVal;	
        } 
        else 
        {
            $this->erro = true;
            return "ERRO";
	  	}
		$myVal = NULL;
		$myRes = NULL;
    }
	
    public function getSuportes($numsup)
    {
		set_time_limit(0);
		$query_as400  = "SELECT T3.MSGPRP1,T1.NUMSUP,T1.TYPSUP,T2.LIBVAG,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV, ";
		$query_as400 .= "T1.DATPRP,T1.CUMCOL,T1.CUMLIG,T1.ETASUP,T1.CODPRP,T4.NOMPRP ";
		$query_as400 .= "FROM ".$this->BibliotecaAS400.".GESUPE T1 ";
		$query_as400 .= "LEFT JOIN ".$this->BibliotecaAS400.".GEVAG T2 ON T1.NUMVAG = T2.NUMVAG ";
		$query_as400 .= "LEFT JOIN ".$this->BibliotecaAS400.".GELIVE T3 ON T1.NUMLIV = T3.NUMLIV ";
		$query_as400 .= "LEFT JOIN ".$this->BibliotecaAS400.".GEZPRP T4 ON T1.CODPRP = T4.CODPRP ";
		$query_as400 .= "WHERE T1.TYPSUP IN('1','2') AND T1.NUMSUP > $numsup ";						
		$query_as400 .= "GROUP BY ";
		$query_as400 .= "T3.MSGPRP1,T1.NUMSUP,T1.TYPSUP,T2.LIBVAG,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV, ";
		$query_as400 .= "T1.DATPRP,T1.CUMCOL,T1.CUMLIG,T1.ETASUP,T1.CODPRP,T4.NOMPRP ";
		
        $myRes = $this->myConn->prepare($query_as400);
        $myRes->execute();
		$myVal = $myRes->fetchAll(PDO::FETCH_ASSOC);
		$this->totRows = count($myVal);
		if ($this->totRows>0)
        {
            $this->erro = false;
            return $myVal;	
        } 
        else 
        {
            $this->erro = true;
            return "ERRO";
	  	}
		$myVal = NULL;
		$myRes = NULL;
    }*/
	
}
?>
