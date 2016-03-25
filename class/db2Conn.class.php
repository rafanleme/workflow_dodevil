<?php
if ((isset($_REQUEST["db2form"]) AND ($_REQUEST["db2form"]=="yes")) OR (isset($_REQUEST["db2formmulti"]) AND ($_REQUEST["db2formmulti"]=="yes"))){
	include("../include/config.php");
}

  class db2Conn{

    private $db2Conn = NULL;
    private $sql_host = "10.60.252.151";
    private $sql_database = "FGE50AGPOR";
    private $sql_user = "CDP0030";
    private $sql_pass = "RAFA1234";
    private $sql_type = "{iSeries Access ODBC Driver}";

    public function db2Conn(){
    }

    public function db2Open(){
      $this->sql_host = sqlHOSTAS;
   	  $this->sql_database = sqlDATAAS;
   	  $this->sql_user = sqlUSERAS;
   	  $this->sql_pass = sqlPASSAS;
      try {
        $this->db2Conn = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=10.60.252.151;DATABASE=FGE50AGPOR;PROTOCOL=TCPIP;UID=CDP0030;PWD=rafa1234;","CDP0030","rafa1234");	
		
        $this->db2Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
        return $this->db2Conn;
      } catch(PDOException $e){
        print "<font color=red face=verdana size=1><B>Error:</b> ".$e->getMessage()."</font><br/>";
        die();
      }
    }
    
    
	public function ebcdic2word($txt){
		$ebc["0"] = NULL;
		$ebc["40"] = " ";
		$ebc["4A"] = "?";
		$ebc["4B"] = ".";
		$ebc["4C"] = "<";
		$ebc["4D"] = "(";
		$ebc["4E"] = "+";
		$ebc["50"] = "&";
		$ebc["5A"] = "!";
		$ebc["5B"] = "\$";
		$ebc["5C"] = "*";
		$ebc["5D"] = ")";
		$ebc["5E"] = ";";
		$ebc["5F"] = "¬";
		$ebc["60"] = "-";
		$ebc["61"] = "/";
		$ebc["6A"] = "|";
		$ebc["6B"] = ",";
		$ebc["6C"] = "%";
		$ebc["6D"] = "_";
		$ebc["6E"] = ">";
		$ebc["6F"] = "?";
		$ebc["7A"] = ":";
		$ebc["7B"] = "#";
		$ebc["7C"] = "@";
		$ebc["7D"] = "'";
		$ebc["7E"] = "=";
		$ebc["7F"] = "\"";
		$ebc["81"] = "a";
		$ebc["82"] = "b";
		$ebc["83"] = "c";
		$ebc["84"] = "d";
		$ebc["85"] = "e";
		$ebc["86"] = "f";
		$ebc["87"] = "g";
		$ebc["88"] = "h";
		$ebc["89"] = "i";
		$ebc["91"] = "j";
		$ebc["92"] = "k";
		$ebc["93"] = "l";
		$ebc["94"] = "m";
		$ebc["95"] = "n";
		$ebc["96"] = "o";
		$ebc["97"] = "p";
		$ebc["98"] = "q";
		$ebc["99"] = "r";
		$ebc["A1"] = "~ ";
		$ebc["A2"] = "s";
		$ebc["A3"] = "t";
		$ebc["A4"] = "u";
		$ebc["A5"] = "v";
		$ebc["A6"] = "w";
		$ebc["A7"] = "x";
		$ebc["A8"] = "y";
		$ebc["A9"] = "z";
		$ebc["B9"] = "`";
		$ebc["C0"] = "{ ";
		$ebc["C1"] = "A";
		$ebc["C2"] = "B";
		$ebc["C3"] = "C";
		$ebc["C4"] = "D";
		$ebc["C5"] = "E";
		$ebc["C6"] = "F";
		$ebc["C7"] = "G";
		$ebc["C8"] = "H";
		$ebc["C9"] = "I";
		$ebc["D0"] = "} ";
		$ebc["D1"] = "J";
		$ebc["D2"] = "K";
		$ebc["D3"] = "L";
		$ebc["D4"] = "M";
		$ebc["D5"] = "N";
		$ebc["D6"] = "O";
		$ebc["D7"] = "P";
		$ebc["D8"] = "Q";
		$ebc["D9"] = "R";
		$ebc["E0"] = "\\ ";
		$ebc["E2"] = "S";
		$ebc["E3"] = "T";
		$ebc["E4"] = "U";
		$ebc["E5"] = "V";
		$ebc["E6"] = "W";
		$ebc["E7"] = "X";
		$ebc["E8"] = "Y";
		$ebc["E9"] = "Z";
		$ebc["F0"] = "0";
		$ebc["F1"] = "1";
		$ebc["F2"] = "2";
		$ebc["F3"] = "3";
		$ebc["F4"] = "4";
		$ebc["F5"] = "5";
		$ebc["F6"] = "6";
		$ebc["F7"] = "7";
		$ebc["F8"] = "8";
		$ebc["F9"] = "9";
		$cont = strlen($txt);
		$conti = 0;
		$novotxt = NULL;
		for($i=0;$i<=$cont;$i=$i+2){
			$hx = substr($txt,$i,2);
			$novotxt .= $ebc[$hx];
		}
		return $novotxt;	
	}
    

    public function db2Close(){
      if ($this->db2Conn!=NULL){
        //$this->db2Conn=NULL;
        unset($this->db2Conn);
      }
    }

  }

  if (isset($_REQUEST["db2form"]) AND ($_REQUEST["db2form"]=="yes")){
        if (isset($_POST["db2form_sql"])){
           $sqlForm = stripslashes($_POST["db2form_sql"]);
        } else {
           $sqlForm = "";
        }
        //SELECT codpro, ds1pro, pcbpro, uvcsto, zonsts, allsts, dplsts, nivsts, codpal, datrec FROM FGE5006CDM.GEPAL WHERE codpro = '167365' AND zonsts in ('1', '3', '4') AND etapal in ('10', '40') order by datrec//
        //SELECT codpro, ds1pro, pcbpro, uvcsto, zonsts, allsts, dplsts, nivsts, codpal, datrec, motimm FROM FGE5006CDM.GEPAL WHERE codpro = '082142' AND etapal in ('10', '40') order by datrec;
  	echo "<html><body><form action=db2Conn.class.php?db2form=yes method=post><textarea name=db2form_sql cols=100 rows=10 wordwrap=yes>".$sqlForm."</textarea><input type=submit value=ok><p>";
  	if(!empty($sqlForm)){
	    $strSql2 = $sqlForm;
	    $teste2 = new db2Conn();
	    $myConn2 = $teste2->db2Open();
	    $myRes2 = $myConn2->prepare($strSql2);
	    $myRes2->execute();
	    $myVal2 = $myRes2->fetchAll(PDO::FETCH_BOTH);
	    $cont2 = count($myVal2);
	    echo "TOTAL REGISTROS: ".$cont2."<p>";
	    //print_r($myVal2);
	    //echo "<p>";
	    //print_r(array_keys($myVal2[0]));
	    $idxName = array_keys($myVal2[0]);
	    //echo "<p>".count($idxName);
	    echo "<p><table border=1 cellpadding=5 cellspacing=0><tr>";
	    for ($i=0;$i<count($idxName);$i++){
	    	echo "<td bgcolor=silver><b>".$idxName[$i]."</b></td>";
	    	$i++;
	    }
	    echo "</tr>";
	    for ($i2=0;$i2<$cont2;$i2++){
	    	echo "<tr>";
		for ($i3=0;$i3<count($idxName);$i3++){
		    echo "<td>".($myVal2[$i2][$idxName[$i3]])."</td>";
		    $i3++;
		}
	    	echo "</tr>";
	    }

	    echo "<table>";
	    $myConn2 = $teste2->db2Close();
	    $myConn2 = NULL;
	    $myVal2 = NULL;
	    $myRes2 = NULL;
  	}
  	echo "</body></html>";
	  /*$strSql = "SELECT codpro, zonsts, allsts, dplsts, nivsts, sum(uvcsto) cxs FROM FGE5006CDM.GEPAL WHERE zonsts IN ('1', '3', '4') AND motimm='   ' GROUP BY codpro, zonsts, allsts, dplsts, nivsts ";
	  $teste = new db2Conn();
	  $myConn = $teste->db2Open();
	  $myRes = $myConn->prepare($strSql);
	  $myRes->execute();
	  $myVal = $myRes->fetchAll(PDO::FETCH_BOTH);
	  $cont = count($myVal);
	  echo $cont."<p>";
	  //print_r($myVal);
	  for($idx=0;$idx<$cont;$idx++){
		echo $idx." - PRODUTO = ".$myVal[$idx]["CODPRO"]."<br>";
	  }
	  $myVal = NULL;
	  $myRes = NULL;
	///////////////////////////////
	  $strSql2 = "SELECT * FROM FGE5006CDM.GEPRO WHERE codpro='2297J6926'";//A 3155H1438
	  $teste2 = new db2Conn();
	  $myConn2 = $teste2->db2Open();
	  $myRes2 = $myConn2->prepare($strSql2);
	  $myRes2->execute();
	  $myVal2 = $myRes2->fetchAll(PDO::FETCH_BOTH);
	  $cont2 = count($myVal2);
	  echo $cont2."<p>";
	  print_r($myVal2);
	  //for($idx=0;$idx<$cont2;$idx++){
	  //	echo $idx." - PRODUTO = ".$myVal2[$idx]["DS1PRO"]."<br>";
	  ///}
	  $myVal = NULL;
	  $myRes = NULL;*/
  }



















  if (isset($_REQUEST["db2formmulti"]) AND ($_REQUEST["db2formmulti"]=="yes")){
        if (isset($_POST["db2form_sql"])){
           $sqlForm = stripslashes($_POST["db2form_sql"]);
        } else {
           $sqlForm = "";
        }
        //SELECT codpro, ds1pro, pcbpro, uvcsto, zonsts, allsts, dplsts, nivsts, codpal, datrec FROM FGE5006CDM.GEPAL WHERE codpro = '167365' AND zonsts in ('1', '3', '4') AND etapal in ('10', '40') order by datrec//
        //SELECT codpro, ds1pro, pcbpro, uvcsto, zonsts, allsts, dplsts, nivsts, codpal, datrec, motimm FROM FGE5006CDM.GEPAL WHERE codpro = '082142' AND etapal in ('10', '40') order by datrec;
  	echo "<html><body><form action=db2Conn.class.php?db2formmulti=yes method=post><textarea name=db2form_sql cols=100 rows=10 wordwrap=yes>".$sqlForm."</textarea><input type=submit value=ok><p>";
  	if(!empty($sqlForm)){
	    $strSql2 = explode(";",$sqlForm);
	    $teste2 = new db2Conn();
	    $myConn2 = $teste2->db2Open();

	    foreach ($strSql2 as $key => $valor){
			$myRes2 = $myConn2->prepare($valor);
			$myRes2->execute();
	    }

	    $myVal2 = $myRes2->fetchAll(PDO::FETCH_BOTH);
	    $cont2 = count($myVal2);
	    echo "TOTAL REGISTROS: ".$cont2."<p>";
	    //print_r($myVal2);
	    //echo "<p>";
	    //print_r(array_keys($myVal2[0]));
	    $idxName = array_keys($myVal2[0]);
	    //echo "<p>".count($idxName);
	    echo "<p><table border=1 cellpadding=5 cellspacing=0><tr>";
	    for ($i=0;$i<count($idxName);$i++){
	    	echo "<td bgcolor=silver><b>".$idxName[$i]."</b></td>";
	    	$i++;
	    }
	    echo "</tr>";
	    for ($i2=0;$i2<$cont2;$i2++){
	    	echo "<tr>";
		for ($i3=0;$i3<count($idxName);$i3++){
		    echo "<td>".$myVal2[$i2][$idxName[$i3]]."</td>";
		    $i3++;
		}
	    	echo "</tr>";
	    }

	    echo "<table>";
	    $myConn2 = $teste2->db2Close();
	    $myConn2 = NULL;
	    $myVal2 = NULL;
	    $myRes2 = NULL;
  	}
  	echo "</body></html>";
  }


?>