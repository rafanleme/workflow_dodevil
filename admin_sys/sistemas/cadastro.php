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

  $sys_conteudo_sp_url = "../../";
  include($sys_conteudo_sp_url."verifica_sessao.php");

  if ($acao=="e"){
     $inst = "SELECT * FROM sys_sistema WHERE ss_id=".$ss_id;
     $resu = mysql_query($inst);
     $valo = mysql_fetch_array($resu);
     $ss_id = $valo["ss_id"];
     $ss_nome = $valo["ss_nome"];
     $ss_contexto = $valo["ss_contexto"];
     $ss_descricao = $valo["ss_descricao"];
     $ss_db = $valo["ss_db"];
  } else if ($acao=="i"){
     $ss_id="novo";
     $ss_nome="";
     $ss_contexto="";
     $ss_db="";
     $ss_descricao="";
  }
?>
<!--
/*#####################################################################
#...........INFORMACAO.SOBRE.O.DESENVOLVIMENTO.E.A.CRIACAO............#
#######################################################################
#....Database Admnistrator / Programmer:....Juliano Muniz.............#
#................................E-mail:....juliano.muniz@uol.com.br..#
#...............................Celular:....(11) 9598-4965............#
#.....................................................................#
#."BEM-AVENTURADO aquele que teme ao Senhor e anda nos seus caminhos..#
#.Pois comeras do trabalho das tuas maos; feliz seras, e te ira bem.".#
#..........................................* Salmo 128:1-2............#
#####################################################################*/
//-->
<html>
<head>
<title><? echo $titulo_pagina;?></title>
<link href="../../include/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function voltar(){
  location.href='index.php';
}
function verificar(){
  if(confirm("Deseja salvar as alterações?")){
    document.frm_cadastro.submit();
  }
}
//-->
</script>
</head>
<body bgcolor="white" text="#000000" link="#FF0000" vlink="#800000" alink="#FF00FF" marginwidth=20 marginheight=10 topmargin=10 leftmargin=20 background="<?echo $sys_conteudo_sp_url;?>images/fundo.jpg" bgproperties="FIXED">
<table border=0 cellpadding=0 cellspacing=0 width=100%><tr>
<td id="home" valign=top>
<table border=0 cellpadding=1 cellspacing=2 width=100%>
<tr>
  <td id="titulo2"><b>CADASTRO DE SISTEMAS</b></td>
</tr>
<tr>
  <td HEIGHT=1 BGCOLOR=black></td>
</tr>
</table>
<form action="aplicar.php" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="<?echo $acao ?>">
<input type="hidden" name="ss_id" value="<?echo $ss_id ?>">
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td id="titulo_conc" valign=top colspan=4>CADASTRO DE SISTEMA</td>
</tr>
<tr>
  <td id="label" valign=top>ID</td>
  <td id="home" valign=top><?echo $ss_id?></td>
</tr>
<tr>
  <td id="label" valign=top>NOME</td>
  <td id="home" valign=top><input type="text" size=40 name="ss_nome" value="<?echo $ss_nome ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>CONTEXTO</td>
  <td id="home" valign=top><input type="text" size=40 name="ss_contexto" value="<?echo $ss_contexto ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>DB</td>
  <td id="home" valign=top><input type="text" size=40 name="ss_db" value="<?echo $ss_db ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>DESCRIÇÃO</td>
  <td id="home" valign=top><textarea cols=40 rows=3 name="ss_descricao"><?echo $ss_descricao ?></textarea></td>
</tr>
<tr><td width=100% height=1 colspan=10><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
<tr>
  <td colspan="2" align="center">&nbsp;<br>
  <input type="button" name="entrar" value="salvar" id="input_btn_send" onclick="verificar();">
  <input type="button" name="cancelar" value=" cancelar " id="input_btn_excluir" onclick="voltar();">
  &nbsp; &nbsp; 
</td></tr>
</table>
</form>

</td>
</tr></table>
</body>
</html>

<? include ($sys_conteudo_sp_url."bottom.php");?>