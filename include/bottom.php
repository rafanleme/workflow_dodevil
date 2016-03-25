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

////////////////////////////////////////////////////////////
// INTERFACE DE DESCONEXAO DO PHP COM O MYSQL
////////////////////////////////////////////////////////////
  mysql_close($conexao);
  if (file_exists("header.inc")){
    echo "<SCRIPT LANGUAGE=\"JavaScript1.2\" SRC=\"../menu/HM_Loader.js\" TYPE=\"text/javascript\"></SCRIPT>";
  } else if (file_exists("include/header.inc")){
    echo "<SCRIPT LANGUAGE=\"JavaScript1.2\" SRC=\"menu/HM_Loader.js\" TYPE=\"text/javascript\"></SCRIPT>";
  } else if (file_exists("../include/header.inc")){
    echo "<SCRIPT LANGUAGE=\"JavaScript1.2\" SRC=\"../menu/HM_Loader.js\" TYPE=\"text/javascript\"></SCRIPT>";
  } else if (file_exists("../../include/header.inc")){
    echo "<SCRIPT LANGUAGE=\"JavaScript1.2\" SRC=\"../../menu/HM_Loader.js\" TYPE=\"text/javascript\"></SCRIPT>";
  } else if (file_exists("../../v1/include/header.inc")){
    echo "<SCRIPT LANGUAGE=\"JavaScript1.2\" SRC=\"../../v1/menu/HM_Loader.js\" TYPE=\"text/javascript\"></SCRIPT>";
  }
?>
<script language="JavaScript">
<!--
 //  loadTip();
//-->
</script>
<?
$marcador_final= microtime(1);
$tempo_execucao = $marcador_final - $marcador_inicial;
$te_tempo = "\nScript: ".$PHP_SELF." - tempo de execução server-side: " .sprintf ( "%02.3f", $tempo_execucao ). " segundos. Data: ".date("d/m/Y - H:i:s");
//$fp = fopen('../../tempo_execucao.txt', 'a+');
//fwrite($fp, $te_tempo);
//fclose($fp);

?>