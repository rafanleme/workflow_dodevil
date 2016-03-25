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
function novo_grupo(){
  document.frm_cadastro.acao.value = "i";
  document.frm_cadastro.sg_id.value = "";
  document.frm_cadastro.action = "cadastro.php";
  document.frm_cadastro.submit();
}
function editar_grupo(x){
  document.frm_cadastro.acao.value = "e";
  document.frm_cadastro.sg_id.value = x;
  document.frm_cadastro.action = "cadastro.php";
  document.frm_cadastro.submit();
}
function deletar_grupo(x){
  if (confirm("Deseja excluir esse grupo?")){
    document.frm_cadastro.acao.value = "d";
    document.frm_cadastro.sg_id.value = x;
    document.frm_cadastro.action = "aplicar.php";
    document.frm_cadastro.submit();
  }
}
function acesso_grupo(x,y){
  document.frm_cadastro.acao.value = "i";
  document.frm_cadastro.sg_id.value = x;
  document.frm_cadastro.a_sg_nome.value = y;
  document.frm_cadastro.action = "acesso.php";
  document.frm_cadastro.submit();
}
//-->
</script>
</head>
<body bgcolor="white" text="#000000" link="#FF0000" vlink="#800000" alink="#FF00FF" marginwidth=20 marginheight=10 topmargin=10 leftmargin=20 background="<?echo $sys_conteudo_sp_url;?>images/fundo.jpg" bgproperties="FIXED">
<table border=0 cellpadding=0 cellspacing=0 width=100%><tr>
<td id="home" valign=top>
<table border=0 cellpadding=1 cellspacing=2 width=100%>
<tr>
  <td id="titulo2"><b>CADASTRO DE GRUPOS</b></td>
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
<form action="cadastro.php" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="i">
<input type="hidden" name="sg_id" value="0">
<input type="hidden" name="a_sg_nome" value="0">
<div align=right><a href="javascript:novo_grupo();void(0);"><img src="../../images/btn_add.png" border=0 alt="adicionar novo usuário">&nbsp;adicionar novo grupo</a></div>
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td valign=top><img src="../../images/btn_key.png" border=0 alt="ID"></td>
  <td id="titulo_conc" valign=top>NOME</td>
  <td id="titulo_conc" valign=top>STATUS</td>
  <td id="titulo_conc" valign=top>OPÇÕES</td>
</tr>
<tr><td width=100% height=1 colspan=10><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
<?
  $inst = "SELECT * FROM sys_grupo ORDER BY sg_nome ASC";
  $resu = mysql_query($inst);
  while($valo = mysql_fetch_array($resu)){
      $x = $valo["sg_status"];
      $y = $valo["sg_id"];
      $z = $valo["sg_nome"];
      $url_ed = "<a href=\"javascript:editar_grupo(".$y.");void(0);\"><img src=\"../../images/btn_edit.png\" border=0 alt=\"editar grupo\"></a>";
      $url_ex = "<a href=\"javascript:deletar_grupo(".$y.");void(0);\"><img src=\"../../images/btn_del.png\" border=0 alt=\"excluir grupo\"></a>";
      $url_ac = "<a href=\"javascript:acesso_grupo(".$y.",'".$z."');void(0);\"><img src=\"../../images/btn_access.png\" border=0 alt=\"acessos do grupo\"></a>";
      echo "<tr class=\"lktb_item\">";
      echo "  <td valign=top id=\"home3\">".$valo["sg_id"]."</td>";
      echo "  <td valign=top id=\"home3\"><b>".$valo["sg_nome"]."</b></td>";
      echo "  <td valign=top id=\"home3\">".get_status($x)."</td>";
      echo "  <td valign=top id=\"home3\">";
          echo $url_ed;
          echo " ";
          echo $url_ex;
          echo " ";
          echo $url_ac;
      echo "</td>";
      echo "</tr>";
      echo "<tr><td width=100% height=1 colspan=10><img src=\"../../images/gray1px.gif\" width=100% height=1 border=0></td></tr>";
  }
?>
</table>
</form>

</td>
</tr></table>
</body>
</html>
<? include ($sys_conteudo_sp_url."bottom.php");?>