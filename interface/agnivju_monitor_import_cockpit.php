<?php 
echo "=====================================================================\n";
echo "                 EXECUTANDO IMPORTA COCKPIT                          \n";
echo "=====================================================================\n";

error_reporting(0);

echo "Iniciou em: ".date("Y-m-d - H:i:s")."\n";
echo "Executando Importacao!";

include_once 'cfg/mysql_agnivju.php';
include_once 'cfg/adodb/adodb.inc.php';
$conteudo = NULL;
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

$sql_busca_onda = "SELECT max(numsup) ultimo FROM cad_cockpit";
$result = mysql_query($sql_busca_onda);

while($row = mysql_fetch_array($result))
{	
	$numsup = $row['ultimo'];
	//$numsup = 15132833;

	$sql1 = odbc_exec($Connection,  "SELECT T3.MSGPRP1,T1.NUMSUP,T1.TYPSUP,T2.LIBVAG,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV,
									 T1.DATPRP,T1.CUMCOL,T1.CUMLIG,T1.ETASUP,T1.CODPRP,T4.NOMPRP
									 FROM ".$BibliotecaAS400.".GESUPE T1
									 LEFT JOIN ".$BibliotecaAS400.".GEVAG T2 ON T1.NUMVAG = T2.NUMVAG
									 LEFT JOIN ".$BibliotecaAS400.".GELIVE T3 ON T1.NUMLIV = T3.NUMLIV
									 LEFT JOIN ".$BibliotecaAS400.".GEZPRP T4 ON T1.CODPRP = T4.CODPRP								   								   								   
									 WHERE T1.TYPSUP IN('1','2') AND T1.NUMSUP > $numsup
									 GROUP BY
									 T3.MSGPRP1,T1.NUMSUP,T1.TYPSUP,T2.LIBVAG,T1.NUMVAG,T3.NOMTRA,T1.NOMCLI,T1.DATLIV,
									 T1.DATPRP,T1.CUMCOL,T1.CUMLIG,T1.ETASUP,T1.CODPRP,T4.NOMPRP"); 

	while ($campo = odbc_fetch_array($sql1))
	{
		$perfil = substr($campo['MSGPRP1'],0,2);
		if($perfil == '  ') { $perfil = '03';}
		
		$busca_perfil = "SELECT ct_id,ct_nome,SUM(cpt_tempo) cpt_tempo FROM cad_perfil_tarefa LEFT JOIN cad_perfil ON cpt_cp_id = cp_id 
						 LEFT JOIN cad_tarefa ON cpt_ct_id = ct_id
						 WHERE cp_id = '$perfil'
						 AND cp_status = 1
						 AND ct_status = 1
						 GROUP BY ct_nome
						 ORDER BY ct_id";

		$query_perfil = mysql_query($busca_perfil);
		
		$tempo_tarefas = 0; 	//VARIAVEL PARA ACUMULAR TODOS OS TEMPO DAS TAREFAS.
				
		while($conteudo  = mysql_fetch_array($query_perfil))				 
		{
			$busca_calculo = "SELECT * FROM cad_calculo WHERE cc_cp_id = $perfil AND cc_ct_id = $conteudo[ct_id]";
			$query_calculo = mysql_query($busca_calculo);
			$i = 0;			
			
			while($fetch = mysql_fetch_array($query_calculo))
			{
				switch($fetch['cc_operacao'])
				{
					case 'multiplicacao':
						$var1 = strtoupper($fetch['cc_alvo1']);
						$var2 = strtolower($fetch['cc_alvo2']);
						$tempo_tarefas += $campo[$var1]*$conteudo[$var2];
						$i++;
						break;
				}
			}
			if($i == 0) { $tempo_tarefas += $conteudo['cpt_tempo']; }
		}

		$datprp = substr($campo['DATPRP'],0,4).'-'.substr($campo['DATPRP'],4,2).'-'.substr($campo['DATPRP'],6,2);
		$janela = substr($campo['LIBVAG'],15,2)." days";
		$data_janela =  date('Y-m-d', strtotime("$janela",strtotime($datprp)))." ".substr($campo['LIBVAG'],8,5); 		
		
		$sql_insert = "INSERT INTO cad_cockpit(msgprp1,numsup,typsup,janela,numvag,nomtra,nomcli,datliv,datprp,cumcol,cumlig,etasup,datjan,codprp,nomprp,tempo)
			    	   VALUES('$perfil','$campo[NUMSUP]','$campo[TYPSUP]','$campo[LIBVAG]','$campo[NUMVAG]','".utf8_encode($campo['NOMTRA'])."',
						      '$campo[NOMCLI]','$campo[DATLIV]','$campo[DATPRP]','$campo[CUMCOL]','$campo[CUMLIG]','$campo[ETASUP]',
							  '".$data_janela."','$campo[CODPRP]','$campo[NOMPRP]','$tempo_tarefas')";
		mysql_query($sql_insert);
	}
}

odbc_close($Connection);

echo "\nFinalizou em: ".date("Y-m-d - H:i:s")."\n";
?>
