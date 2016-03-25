<?
  $sys_conteudo_sp_url = "";
  include($sys_conteudo_sp_url."verifica_sessao.php");
  $_SESSION["ses_ss_id"] = $_POST["ss_id"];
  $_SESSION["ses_ss_nome"] = $_POST["ss_nome"];  
?>
<!--
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
//-->
<html>
<head>
  <title>ADMINISTRACAO</title>
</head>
<frameset cols="130,*" frameborder="0" border="0" framespacing="0">
  <frame name="CONTEUDO_Adm_nada" src="adm_menu.php" marginwidth="0" marginheight="0" frameborder="0"  border="0" noresize scrolling=no>
  <frame name="CONTEUDO_Bdm_home" src="adm_home.php" marginwidth="0" marginheight="0" frameborder="0" noresize scrolling=yes>
</frameset>
</html>
<? include ("include/bottom.php");?>