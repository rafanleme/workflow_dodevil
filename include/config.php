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

////////////////////////////////////////////////////////////
// CONFIGURACAO DO MYSQL
////////////////////////////////////////////////////////////

   if(($_SERVER["SERVER_NAME"]=="thebeast") OR ($_SERVER["SERVER_NAME"]=="190.67.10.100")  OR ($GLOBALS["AMBIENTE"]=="localhost") OR ($_SERVER["SERVER_NAME"]=="localhost")){
   	$host = "localhost";
   	$pass = "@sispcp";
   	$database = "workflow_dodevil";
   	$user = "sispcp";
   	$ambiente = "<div style='width:100%;height:25px;background-color:red;text-align:center;align:center;vertical-align:middle;'><font face=verdana size=2 color=white><b><marquee>* * * * * * DATABASE EM AMBIENTE DE TESTE * * * * * *</marquee></b></font></div>";
   }elseif(($_SERVER["SERVER_NAME"]=="ti-developer") OR ($_SERVER["SERVER_NAME"]=="190.67.10.71")  OR ($GLOBALS["AMBIENTE"]=="teste")){
   	$host = "localhost";
   	$pass = "";
   	$database = "";
   	$user = "";
   	$ambiente = "<div style='width:100%;height:25px;background-color:red;text-align:center;align:center;vertical-align:middle;'><font face=verdana size=2 color=white><b><marquee>* * * * * * DATABASE EM AMBIENTE DE TESTE * * * * * *</marquee></b></font></div>";
   }else{
	$host = "localhost";
   	$pass = "";
   	$database = "workflow_dodevil";
   	$user = "root";
   	$ambiente = "";
   }

   define("sqlHOST", $host);
   define("sqlDATA", $database);
   define("sqlUSER", $user);
   define("sqlPASS", $pass);

   static $hostAS = "10.60.252.151";
   static $passAS = "DARTUR";
   static $databaseAS = "FGE50AGNIV";
   static $userAS = "CDNJ0991";
   define("sqlHOSTAS", $hostAS);
   define("sqlDATAAS", $databaseAS);
   define("sqlUSERAS", $userAS);
   define("sqlPASSAS", $passAS);


 $titulo_pagina = ":: SISTEMA SISPCP ::";


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


 function printEtiqueta($fncIP, $fncItem, $fncDesc, $fncQtde, $fncLote, $fncData, $fncKanban, $fncNumpal, $fncLinha){
 	//$printer = "zql105";
//$fp = fopen('printlog.txt', 'a+');
//fwrite($fp, $fncIP."\n");
//fclose($fp);

 	$printer = "cdam_zebra03";
 	//$printer = "mzql42";

 	if($fncIP=="10.106.26.64"){
 		$printer = "mzql42";
 	/*} else if($fncIP=="10.106.26.61"){
 		$printer = "mzql42";
 	} else if($fncIP=="10.106.26.62"){
 		$printer = "mzql42";
 	} else if($fncIP=="10.106.26.63"){
 		$printer = "mzql42";
 	} else if($fncIP=="10.106.26.64"){
 		$printer = "mzql42";
 	} else if($fncIP=="mzql42"){
 		$printer = "mzql42";
 	} else if($fncIP=="mzql42"){
 		$printer = "mzql42";
 	} else if($fncIP=="mzql42"){
 		$printer = "mzql42";
 	} else if($fncIP=="mzql42"){
 		$printer = "mzql42";
 	} else if($fncIP=="mzql42"){
 		$printer = "mzql42";*/
 	} else {
 		$printer = "cdam_zebra03";
 	}
 	if($ph = printer_open($printer)){
 	   echo "Etiqueta gerada";
 	   /*$impressao = "
 		^XA
 		  ^A0,30,20
 		  ^FO10,10^AE^FD ITEM: $fncItem ^FS
 		  ^FO10,40^AE^FD $fncDesc ^FS
 		  ^FO10,70^AE^FD QTDE: $fncQtde ^FS
 		  ^FO10,100^AE^FD LOTE: $fncLote ^FS
 		  ^FO10,130^AE^FD DATA: $fncData ^FS
 		  ^FO20,180^AD^FD E-KANBAN ^FS
 		  ^FO20,200^B3,,60^FD$fncKanban^FS
 		  ^FO20,300^AD^FD NUMPAL ^FS
 		  ^FO20,320^B3,,100^FD$fncNumpal^FS
 		  ^FO20,460^AE,^FD $fncLinha ^FS
 		  ^XZ
 	   ";*/
 	   $fncNumpal = fillStr("i",$fncNumpal,9);
 	   $impressao = "
 		^XA
 		  ^A0,0,0
 		  ^FO0,1^GB1000,8,8^FS
 		  ^FO0,550^GB1000,8,8^FS
 		  ^FO0,110^GB1000,2,2^FS
 		  ^FO0,180^GB1000,2,2^FS
 		  ^FO400,110^GB2,070,2^FS
 		  ^FO0,250^GB1000,2,2^FS
 		  ^FO400,180^GB2,070,2^FS
 		  ^FO0,380^GB1000,2,2^FS
 		  ^A0N,30,30^FO10,25^FD ITEM: ^FS
 		  ^A0N,40,40^FO110,20^FD $fncItem ^FS
 		  ^A0N,40,40^FO10,65^FD $fncDesc ^FS
 		  ^A0N,30,30^FO10,135^FD QTDE: ^FS
 		  ^A0N,40,40^FO90,130^FD $fncQtde ^FS
 		  ^A0N,30,30^FO420,135^FD $fncLinha ^FS
 		  ^A0N,30,30^FO10,205^FD $fncLote ^FS
 		  ^A0N,40,40^FO90,200^FD   ^FS
 		  ^A0N,30,30^FO420,205^FD DATA ^FS
 		  ^A0N,40,40^FO510,200^FD $fncData ^FS
 		  ^A0N,30,30^FO10,300^FD E-KANBAN ^FS
 		  ^FO230,280^B3,,60^FD$fncKanban^FS
 		  ^A0N,30,30^FO10,440^FD NUMPAL ^FS
 		  ^FO230,410^B3,,100^FD$fncNumpal^FS
 		  ^XZ
 	   ";
 	   //printer_set_option($ph, PRINTER_MODE, "raw");
 	   //printer_write($ph, $impressao);
 	   //printer_close($ph);
 	} else {
 	   echo "Couldn't connect...";
 	}
}



?>