<?
  $sys_conteudo_sp_url = "../../";
  include($sys_conteudo_sp_url."verifica_sessao.php");
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
function usuarios(){
  document.frm_cadastro.action = "index.php";
  document.frm_cadastro.submit();
}
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
  <td id="titulo2"><b>CADASTRO DE GRUPOS POR USUÁRIO</b></td>
</tr>
<tr>
  <td HEIGHT=1 BGCOLOR=black></td>
</tr>
</table>

       <font face=verdana color=red size=1><B>
       <? if (!empty($mensagem)){
            echo $mensagem;
          }
       ?>
       </b></font><p>
<form action="aplicar2.php" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="i">
<input type="hidden" name="su_id" value="<? echo $su_id ?>">
<input type="hidden" name="su_nome" value="<? echo $su_nome ?>">
<a href="javascript:usuarios();void(0);"><img src="../../images/btn_user.png" border=0 alt="voltar aos usuários"></a>
<b>USUÁRIO:</b> <i><font color=green><? echo $su_nome ?></font></i><p>
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td valign=top><img src="../../images/btn_key.png" border=0 alt="ID"></td>
  <td id="titulo_conc" valign=top>NOME DO GRUPO</td>
  <td valign=top><img src="../../images/btn_alert.png" border=0 alt="Ele faz parte?"></td>
  <td id="titulo_conc" valign=top>ACESSO</td>
</tr>
<tr><td width=100% height=1 colspan=10><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
<?
  $inst = "SELECT * FROM sys_grupo ORDER BY sg_nome ASC";
  $resu = mysql_query($inst);
  $cont = mysql_num_rows($resu);
  $contador = 0;
  while($valo=mysql_fetch_array($resu)){
     $valor_check = $su_id."#".$valo["sg_id"];
     $inst_get = "SELECT * FROM sys_usuario_rel_grupo WHERE surg_su_id=".$su_id." AND surg_sg_id=".$valo["sg_id"].";";
     $resu_get = mysql_query($inst_get);
     $valo_get = mysql_fetch_array($resu_get);
     $cont_get = mysql_num_rows($resu_get);
     if ($cont_get>0){
        $campo_sel = "checked";
     } else {
        $campo_sel = "";
     }           
     echo "<tr class=\"lktb_item\"><td valign=top id=\"home3\">".$valo["sg_id"]."</td>";
     echo "<td valign=top id=\"home3\"><b>".$valo["sg_nome"]."</b></td>";
     echo "<td valign=top id=\"home3\" width=16><input type=\"checkbox\" name=\"check_".$contador."\" value=\"$valor_check\" id=\"input_nada\" $campo_sel></td>";
     if ($valo_get["surg_tipo"]=="admin"){
        echo "<td valign=top id=\"home3\"><select name=\"select_".$contador."\"><option value=\"user\">user</option><option value=\"admin\" selected>admin</option></select></td>";
     } else { 
        echo "<td valign=top id=\"home3\"><select name=\"select_".$contador."\"><option value=\"user\" selected>user</option><option value=\"admin\">admin</option></select></td>";
     }
     $contador++;
  }
  $contador = $contador-1;
  if ($cont==0){
        echo "<tr><td colspan=3 id=home3><font color=silver>Não existe grupos nesse sistema!</font></td></tr>";
  }
  echo "<tr><td width=100% height=1 colspan=10><img src=\"../../images/gray1px.gif\" width=100% height=1 border=0></td></tr>";
?>
<tr>
  <td colspan="3" align="center">&nbsp;<br>
  <input type="button" name="entrar" value="salvar" id="input_btn_send" onclick="verificar();">
  <input type="button" name="cancelar" value=" cancelar " id="input_btn_excluir" onclick="voltar();">
  &nbsp; &nbsp; 
</td></tr>
</table>
<input type="hidden" name="contador" value="<?echo $contador;?>">
</form>

</td>
</tr></table>
</body>
</html>
<? include ($sys_conteudo_sp_url."bottom.php");?>