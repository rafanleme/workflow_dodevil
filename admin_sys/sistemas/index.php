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
function novo_sistema(){
  document.frm_cadastro.acao.value = "i";
  document.frm_cadastro.ss_id.value = "";
  document.frm_cadastro.action = "cadastro.php";
  document.frm_cadastro.submit();
}
function editar_sistema(x){
  document.frm_cadastro.acao.value = "e";
  document.frm_cadastro.ss_id.value = x;
  document.frm_cadastro.action = "cadastro.php";
  document.frm_cadastro.submit();
}
function deletar_sistema(x){
  if (confirm("Deseja excluir esse sistema?")){
    document.frm_cadastro.acao.value = "d";
    document.frm_cadastro.ss_id.value = x;
    document.frm_cadastro.action = "aplicar.php";
    document.frm_cadastro.submit();
  }
}
function ferramentas(x,y,z){
  document.frm_cadastro.action = "../ferramentas/index.php";
  document.frm_cadastro.ss_id.value = x;
  document.frm_cadastro.ss_nome.value = y;
  document.frm_cadastro.ss_path.value = z;
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
  <td id="titulo2"><b>CADASTRO DE SISTEMAS</b></td>
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
<input type="hidden" name="ss_id" value="0">
<input type="hidden" name="ss_nome" value=" ">
<input type="hidden" name="ss_path" value=" ">
<div align=right><a href="javascript:novo_sistema();void(0);"><img src="../../images/btn_add.png" border=0 alt="adicionar novo sistema">&nbsp;adicionar novo sistema</a></div>
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td valign=top><img src="../../images/btn_key.png" border=0 alt="ID"></td>
  <td id="titulo_conc" valign=top>NOME</td>
  <td id="titulo_conc" valign=top>CONTEXTO</td>
  <td id="titulo_conc" valign=top>DB</td>
  <td id="titulo_conc" valign=top>OPÇÕES</td>
</tr>
<tr><td width=100% height=1 colspan=10><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
<?
  $inst = "SELECT * FROM sys_sistema ORDER BY ss_nome ASC";
  $resu = mysql_query($inst);
  while($valo = mysql_fetch_array($resu)){
      $y = $valo["ss_id"];
      $x = $valo["ss_nome"];
      $z = $valo["ss_contexto"];
      $url_ed = "<a href=\"javascript:editar_sistema(".$y.");void(0);\"><img src=\"../../images/btn_edit.png\" border=0 alt=\"editar sistema\"></a>";
      $url_ex = "<a href=\"javascript:deletar_sistema(".$y.");void(0);\"><img src=\"../../images/btn_del.png\" border=0 alt=\"excluir sistema\"></a>";
      $url_fe = "<a href=\"javascript:ferramentas(".$y.",'".$x."','".$z."');void(0);\"><img src=\"../../images/btn_tool.png\" border=0 alt=\"ferramentas\"></a>";
      echo "<tr class=\"lktb_item\">";
      echo "  <td valign=top id=\"home3\">".$valo["ss_id"]."</td>";
      echo "  <td valign=top id=\"home3\"><b>".$valo["ss_nome"]."</b></td>";
      echo "  <td valign=top id=\"home3\">".$valo["ss_contexto"]."</td>";
      echo "  <td valign=top id=\"home3\">".$valo["ss_db"]."</td>";
      echo "  <td valign=top id=\"home3\">";
          echo $url_ed;
          echo " ";
          echo $url_ex;
          echo " ";
          echo $url_fe;
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