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
     $inst = "SELECT * FROM sys_usuario WHERE su_id=".$su_id;
     $resu = mysql_query($inst);
     $valo = mysql_fetch_array($resu);
     $su_prontuario =  $valo["su_login"];
     $su_nome = $valo["su_nome"];
     $su_status =  $valo["su_status"];
  } else if ($acao=="i"){
     $su_nome="";
     $su_status="0";
     $su_prontuario = $su_id;
     $su_id = "novo";
  }
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
  <td id="titulo2"><b>CADASTRO DE USUÁRIOS</b></td>
</tr>
<tr>
  <td HEIGHT=1 BGCOLOR=black></td>
</tr>
</table>

<form action="aplicar.php" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="<? echo $acao ?>">
<input type="hidden" name="su_id" value="<? echo $su_id ?>">
<input type="hidden" name="su_prontuario" value="<? echo $su_prontuario ?>">
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td id="titulo_conc" valign=top colspan=4>CADASTRO DE USUÁRIO</td>
</tr>
<tr>
  <td id="label" valign=top>ID</td>
  <td id="home" valign=top><? echo $su_id?></td>
</tr>
<tr>
  <td id="label" valign=top>LOGIN</td>
  <td id="home" valign=top><input type="text" size=10 name="su_prontuario2" value="<? echo $su_prontuario ?>" disabled></td>
</tr>
<tr>
  <td id="label" valign=top>NOME</td>
  <td id="home" valign=top><input type="text" size=40 name="su_nome" value="<? echo $su_nome ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>STATUS</td>
  <td id="home" valign=top>
  <select name="su_status">
    <?
      if ($su_status=="0"){
         echo "<option value=\"1\">habilitado</option>";
         echo "<option value=\"0\" selected>desabilitado</option>";
      } else {
         echo "<option value=\"1\" selected>habilitado</option>";
         echo "<option value=\"0\">desabilitado</option>";
      }
    ?>
  </select>
  </td>
</tr>
<tr><td width=100% height=1 colspan=10><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
<tr>
  <td colspan="2" align="center">&nbsp;<br>
  <input type="button" name="entrar" value="salvar" id="input_btn_send" onClick="verificar();">
  <input type="button" name="cancelar" value=" cancelar " id="input_btn_excluir" onClick="voltar();">
  &nbsp; &nbsp; 
</td></tr>
</table>
</form>

</td>
</tr></table>
</body>
</html>
<? include ($sys_conteudo_sp_url."bottom.php");?>