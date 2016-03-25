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

ini_set ( 'mssql.textlimit' , '65536' );
ini_set ( 'mssql.textsize' , '65536' );

function newData($data){
	$dt = explode("/",$data);
	$ano = $dt[2];
	$mes = $dt[1];
	$dia = $dt[0];
	if($mes<10){ $mes = "0".$mes;}
	if($dia<10){ $dia = "0".$dia;}
	return $ano."-".$mes."-".$dia;
}


$db = new COM("ADODB.Connection");
$dsn = "DRIVER={SQL Server}; SERVER={192.168.13.7};UID={sa};PWD={idsql2009CDVM}; DATABASE={SAFOR}";
$db->Open($dsn);
$rs = $db->Execute("SELECT * FROM tbl_sac_config_ClienteTransportadora ORDER BY razaoSocial");

  $conexao = mysql_connect("10.0.0.1","mqueiroz","vida");
  mysql_select_db("agendamento_nadir",$conexao);

while (!$rs->EOF)
{

   echo $sql = "INSERT INTO cad_transportadora (ct_codigo, ct_razaosocial, ct_cnpj, ct_email, ct_telefone, ct_cidade, ct_uf, ct_status) VALUES(
	   '".$rs->Fields['CodTransportador']->Value."', '".$rs->Fields['razaoSocial']->Value."', '".$rs->Fields['CNPJ']->Value."', '".$rs->Fields['eMail']->Value."', 
	   '".$rs->Fields['Telefone']->Value."', '".$rs->Fields['Cidade']->Value."','".$rs->Fields['UF']->Value."','".$rs->Fields['Status']->Value."'
	   );";
   mysql_query($sql,$conexao);
	//echo $rs->Fields['Descricao']->Value."ok<br>";
   //echo $rs->Fields['descricao_produto']->Value."<BR>";
   $rs->MoveNext();
}
?>