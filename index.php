<? include ("include/header.php");?>

<html>
<head>
<title>:: WORK FLOW DODEVIL ::</title>
<link rel="icon" href="images/icone.png" type="image/png">
<link rel="SHORTCUT ICON" href="images/icone.png" type="image/png">
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
</head>
<? $url_certa="";
   $erro = $_REQUEST["erro"];
   if ((!empty($erro)) AND ($erro=="1")){
     $url_certa = "login.php?mensagem=Voc&ecirc; n&tilde;o t&ecirc;m acesso &agrave; p&aacute;gina!";
   } else if ((!empty($erro)) AND ($erro=="2")){
     $url_certa = "login.php?mensagem=Voc&ecirc; n&atilde;o est&aacute; logado!";
   } else {
     $url_certa = "login.php";
   }
?>
<frameset rows="0,*" border=0 frameborder=0>
  <frame name="Wnd_Sys_conteudo_topo" src="UntitledFrame-1" border=0 frameborder=0 scrolling=no resizable=no>
  <frame name="Wnd_Sys_conteudo_principal" src="<? echo $url_certa ?>" frameborder=0 scrolling=yes resizable=no>
</frameset><noframes></noframes>
</html>
<? include ("include/bottom.php");?> 
<!-- testando 27.03 // -->

