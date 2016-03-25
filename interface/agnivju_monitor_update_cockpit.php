<?php 
echo "=====================================================================\n";
echo "                 EXECUTANDO UPDATE COCKPIT                           \n";
echo "=====================================================================\n";

error_reporting(0);

echo "Iniciou em: ".date("Y-m-d - H:i:s")."\n";
echo "Executando Atualizacao!";

include_once 'cfg/mysql_agnivju.php';
include_once 'cfg/adodb/adodb.inc.php';

dbcon();
dbsel();

exec('ping 10.60.252.151', $saida, $retorno);

print_r($saida);

if(substr($saida[8],37,8) == 'Lost = 0')
{
	echo 'O Servidor esta ONLINE';
}
else
{
	echo 'O Servidor esta OFFLINE';
	//exit;
}

$con_prd = NewADOConnection('db2');
$ODBCname_prd = "FGE50AGNIV";
$usuario_AS = "CDNJ0991";
$password_AS = "DARTUR";
$Connection = odbc_connect($ODBCname_prd, $usuario_AS, $password_AS) or print (odbc_errormsg());
$BibliotecaAS400 = "FGE50AGNIV";

$sql_busca_numsup = "SELECT numsup FROM cad_cockpit WHERE etasup IN('00','10','20','30') ORDER BY etasup";
$result = mysql_query($sql_busca_numsup);

while($row = mysql_fetch_array($result))
{	
	$numsup = $row['numsup'];

	$sql1 = odbc_exec($Connection,  "SELECT 
					T1.NUMSUP,
					T2.LIBVAG,	
					T1.NUMVAG,
					T1.KAILIV,
					T3.NOMTRA,
					T1.NOMCLI,
					T1.DATLIV,
					T1.DATPRP,
					T1.CUMCOL,
					T1.ETASUP,
					T1.CODPRP,
					T4.NOMPRP,
					T1.DATSUP1||DIGITS(T1.HEUSUP1) DATSUP1,
					T1.DATSUP2||DIGITS(T1.HEUSUP2) DATSUP2,
                    T5.DATHIS || DIGITS(T5.HEUHIS) DATSUP3,
                    T6.DATHIS || DIGITS(T6.HEUHIS) DATSUP4
                    FROM ".$BibliotecaAS400.".GESUPE T1
					LEFT JOIN ".$BibliotecaAS400.".GEVAG T2 ON T1.NUMVAG = T2.NUMVAG
					LEFT JOIN ".$BibliotecaAS400.".GELIVE T3 ON T1.NUMLIV = T3.NUMLIV								   
					LEFT JOIN ".$BibliotecaAS400.".GEZPRP T4 ON T1.CODPRP = T4.CODPRP
                    LEFT JOIN (SELECT NUMSUP,DATHIS,MAX(HEUHIS) HEUHIS FROM ".$BibliotecaAS400.".GEHSUP
                               WHERE NUMSUP = $numsup AND ETASUP = '20' 
							   GROUP BY NUMSUP,DATHIS
							   ORDER BY DATHIS DESC FETCH FIRST 1 ROWS ONLY) T5 ON T1.NUMSUP = T5.NUMSUP
                    LEFT JOIN (SELECT NUMSUP,DATHIS,MAX(HEUHIS) HEUHIS FROM ".$BibliotecaAS400.".GEHSUP
                               WHERE NUMSUP = $numsup AND ETASUP = '30' 
							   GROUP BY NUMSUP,DATHIS
							   ORDER BY DATHIS DESC FETCH FIRST 1 ROWS ONLY) T6 ON T1.NUMSUP = T6.NUMSUP
                    WHERE T1.TYPSUP IN('1','2') AND T1.NUMSUP = $numsup
					GROUP BY
					T1.NUMSUP,
					T2.LIBVAG,
					T1.KAILIV,	
					T1.NUMVAG,
					T3.NOMTRA,
					T1.NOMCLI,
					T1.DATLIV,
					T1.DATPRP,
					T1.CUMCOL,
					T1.ETASUP,
					T1.CODPRP,
					T4.NOMPRP,
					T1.DATSUP1||DIGITS(T1.HEUSUP1),
					T1.DATSUP2||DIGITS(T1.HEUSUP2),
                    T5.DATHIS ||DIGITS(T5.HEUHIS), 
                    T6.DATHIS || DIGITS(T6.HEUHIS)"); 
	$i = 0;
	while ($campo = odbc_fetch_array($sql1))
	{
		$i++;
		
		if($campo['DATSUP3'] == '') { $datsup3 = "0000000"; } else { $datsup3 = $campo['DATSUP3']; }
		if($campo['DATSUP4'] == '') { $datsup4 = "0000000"; } else { $datsup4 = $campo['DATSUP4']; }
		
		
		$sql_update = "UPDATE cad_cockpit SET etasup = '$campo[ETASUP]',
					   codprp = '$campo[CODPRP]',
					   nomprp = '$campo[NOMPRP]',
					   datsup1 = '$datsup3',
					   datsup2 = '$datsup4',
					   kailiv = '$campo[KAILIV]'
					   WHERE numsup = $campo[NUMSUP]";
		mysql_query($sql_update);
		
	}
	if($i == 0)
	{
		mysql_query("UPDATE cad_cockpit SET etasup = '00' WHERE numsup = $row[numsup]");
	}
}	

odbc_close($Connection);

echo "\nFinalizou em: ".date("Y-m-d - H:i:s")."\n";
?>