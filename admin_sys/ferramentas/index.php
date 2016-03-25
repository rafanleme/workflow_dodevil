<?
  if (empty($ss_id) OR empty($ss_nome) OR empty($ss_path)){
     echo "<script language=\"JavaScript\">";
     //echo "alert('Sistema de Gerenciamento de Conteúdo \\n\\nVocê precisa escolher o sistema para entrar nessa ferramenta!');";
     echo "var page = \"../sistemas/\";";
     echo "window.location.href = page;";
     echo "</script>";
     exit;
  }
  $sys_conteudo_sp_url = "../../";
  include($sys_conteudo_sp_url."verifica_sessao.php");
  $sf_ss_id = $ss_id;
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
function novo_ferramenta(x,y){
  document.frm_cadastro.acao.value = "i";
  document.frm_cadastro.sf_id.value = x;
  document.frm_cadastro.sf_sf_id.value = y;  
  document.frm_cadastro.action = "cadastro.php";
  document.frm_cadastro.submit();
}
function editar_ferramenta(x,y){
  document.frm_cadastro.acao.value = "e";
  document.frm_cadastro.sf_id.value = x;
  document.frm_cadastro.sf_sf_id.value = y;
  document.frm_cadastro.action = "cadastro.php";
  document.frm_cadastro.submit();
}
function deletar_ferramenta(x,y){
  if (confirm("Deseja excluir essa ferramenta?")){
    document.frm_cadastro.acao.value = "d";
    document.frm_cadastro.sf_id.value = x;
    document.frm_cadastro.sf_sf_id.value = y;
    document.frm_cadastro.action = "aplicar.php";
    document.frm_cadastro.submit();
  }
}
function sistemas(){
  document.frm_cadastro.action = "../sistemas/index.php";
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
  <td id="titulo2"><b>CADASTRO DE FERRAMENTAS</b></td>
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
<input type="hidden" name="sf_id" value="0">
<input type="hidden" name="sf_ss_id" value="<? echo $sf_ss_id ?>">
<input type="hidden" name="ss_nome" value="<?echo $ss_nome ?>">
<input type="hidden" name="ss_path" value="<?echo $ss_path ?>">
<input type="hidden" name="sf_sf_id" value="0">
<div align=right><a href="javascript:novo_ferramenta(0,0);void(0);"><img src="../../images/btn_add.png" border=0 alt="adicionar nova ferramenta">&nbsp;adicionar nova ferramenta</a></div>
<a href="javascript:sistemas();void(0);"><img src="../../images/btn_sys.png" border=0 alt="voltar aos sistemas"></a>
<b>SISTEMA:</b> <i><font color=green><? echo $ss_nome ?></font></i><p>
<table border=0 cellpadding=1 cellspacing=2>
<tr>
  <td valign=top><img src="../../images/btn_key.png" border=0 alt="ID"></td>
  <td id="titulo_conc" valign=top>NOME</td>
  <td id="titulo_conc" valign=top>PATH</td>
  <td id="titulo_conc" valign=top>STATUS</td>
  <td id="titulo_conc" valign=top>OPÇÕES</td>
</tr>
<tr><td width=100% height=1 colspan=10><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
<?
  $inst = "SELECT * FROM sys_ferramenta WHERE sf_sf_id=0 AND sf_ss_id=".$sf_ss_id." ORDER BY sf_nome ASC";
  $resu = mysql_query($inst);
  while($valo=mysql_fetch_array($resu)){
      $x = $valo["sf_status"];
      $y = $valo["sf_id"];
      $z = $valo["sf_sf_id"];
      $url_ed = "<a href=\"javascript:editar_ferramenta(".$y.",".$z.");void(0);\"><img src=\"../../images/btn_edit.png\" border=0 alt=\"editar ferramenta\"></a>";
      $url_ex = "<a href=\"javascript:deletar_ferramenta(".$y.",".$z.");void(0);\"><img src=\"../../images/btn_del.png\" border=0 alt=\"excluir ferramenta\"></a>";
      $url_in = "<a href=\"javascript:novo_ferramenta(".$z.",".$y.");void(0);\"><img src=\"../../images/btn_add.png\" border=0 alt=\"adicionar nova sub-ferramenta\"></a>";
      echo "<tr class=\"lktb_item\">";
      echo "  <td valign=top id=\"home3\">".$valo["sf_id"]."</td>";
      echo "  <td valign=top id=\"home3\"><img src=\"../../images/btn_tool.png\" border=0 alt=\"ferramenta\"><b>".$valo["sf_nome"]."</b></td>";
      echo "  <td valign=top id=\"home3\">".$ss_path."</td>";
      echo "  <td valign=top id=\"home3\">".get_status($x)."</td>";
      echo "  <td valign=top id=\"home3\">";
          echo $url_ed;
          echo " ";
          echo $url_in;
          echo " ";
          echo $url_ex;
      echo "</td>";
      echo "</tr>";
      $inst2 = "SELECT * FROM sys_ferramenta WHERE sf_sf_id=".$y." ORDER BY sf_nome ASC";
      $resu2 = mysql_query($inst2);
      while($valo2 = mysql_fetch_array($resu2)){
        $x = $valo2["sf_status"];
        $y = $valo2["sf_id"];
        $z = $valo2["sf_sf_id"];
        $url_ed = "<a href=\"javascript:editar_ferramenta(".$y.",".$z.");void(0);\"><img src=\"../../images/btn_edit.png\" border=0 alt=\"editar ferramenta\"></a>";
        $url_ex = "<a href=\"javascript:deletar_ferramenta(".$y.",".$z.");void(0);\"><img src=\"../../images/btn_del.png\" border=0 alt=\"excluir ferramenta\"></a>";
        //echo "<tr><td width=1 colspan=10 bgcolor=silver></td></tr>";
        echo "<tr class=\"lktb_item\">";
        echo "  <td valign=top id=\"home3\"><font color=silver>".$valo2["sf_id"]."</font></td>";
        echo "  <td valign=top id=\"home3\"><img src=\"../../images/btn_subtool.png\" border=0 alt=\"sub-ferramenta\">".$valo2["sf_nome"]."</td>";
        echo "  <td valign=top id=\"home3\">".$ss_path.$valo2["sf_path"]."</td>";
        echo "  <td valign=top id=\"home3\">".get_status($x)."</td>";
        echo "  <td valign=top id=\"home3\">";
            echo $url_ed;
            echo " ";
            echo $url_ex;
        echo "</td>";
        echo "</tr>";
      }
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