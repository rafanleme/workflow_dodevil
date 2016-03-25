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
     $inst = "SELECT * FROM sys_ferramenta WHERE sf_id=".$sf_id;
     $resu = mysql_query($inst);
     $valo = mysql_fetch_array($resu);
     $sf_nome = $valo["sf_nome"];
     $sf_sf_id = $valo["sf_sf_id"];
     $sf_descricao = $valo["sf_descricao"];
     $sf_url = $valo["sf_url"];
     $sf_path = $valo["sf_path"];
     $sf_status = $valo["sf_status"];
     $sf_sys_sigla = $valo["sf_sys_sigla"];
  } else if ($acao=="i"){
     $sf_sf_id = $sf_sf_id;
     $sf_id="nova";
     $sf_nome = "";
     $sf_descricao = "";
     $sf_url = "";
     $sf_path = "";
     $sf_status="0";
     $sf_sys_sigla="sys";
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
  document.frm_cadastro.action = "index.php";
  document.frm_cadastro.submit();
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
  <td id="titulo2"><b>CADASTRO DE FERRAMENTAS</b></td>
</tr>
<tr>
  <td HEIGHT=1 BGCOLOR=black></td>
</tr>
</table>
<form action="aplicar.php" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="<?echo $acao ?>">
<input type="hidden" name="sf_id" value="<?echo $sf_id ?>">
<input type="hidden" name="sf_sf_id" value="<?echo $sf_sf_id ?>">
<input type="hidden" name="sf_ss_id" value="<?echo $sf_ss_id ?>">
<input type="hidden" name="ss_id" value="<?echo $sf_ss_id ?>">
<input type="hidden" name="ss_nome" value="<?echo $ss_nome ?>">
<input type="hidden" name="ss_path" value="<?echo $ss_path ?>">
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td id="titulo_conc" valign=top colspan=4>CADASTRO DE FERRAMENTAS</td>
</tr>
<tr>
  <td id="label" valign=top>ID</td>
  <td id="home" valign=top><?echo $sf_id?></td>
</tr>
<tr>
  <td id="label" valign=top>NOME</td>
  <td id="home" valign=top><input type="text" size=40 name="sf_nome" value="<?echo $sf_nome ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>DESCRIÇÃO</td>
  <td id="home" valign=top><textarea cols=40 rows=3 name="sf_descricao"><?echo $sf_descricao ?></textarea></td>
</tr>
<tr>
  <td id="label" valign=top>URL</td>
  <td id="home" valign=top><input type="text" size=40 name="sf_url" value="<?echo $sf_url ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>PATH</td>
  <td id="home" valign=top><input type="text" size=40 name="sf_path" value="<?echo $sf_path ?>"></td>
</tr>
<tr>
  <td id="label" valign=top>PÁGINA DA WEB?</td>
  <td id="home" valign=top>
  <select name="sf_sys_sigla">
    <?
      if ($sf_sys_sigla=="web"){
         echo "<option value=\"web\" selected>sim</option>";
         echo "<option value=\"sys\">não</option>";
      } else {
         echo "<option value=\"web\">sim</option>";
         echo "<option value=\"sys\" selected>não</option>";
      }
    ?>
  </select> <font color=red size=1>ATENÇÃO: somente usar se for paga o sitema website!</font>
  </td>
</tr>
<tr>
  <td id="label" valign=top>STATUS</td>
  <td id="home" valign=top>
  <select name="sf_status">
    <?
      if ($sf_status=="0"){
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