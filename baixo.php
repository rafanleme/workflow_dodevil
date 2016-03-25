<?
  $sys_conteudo_sp_url = "";
  include($sys_conteudo_sp_url."verifica_sessao.php");
  if ($ses_login!="jmuniz" AND $ses_login!="mqueiroz" AND $ses_login!="rleme"){
	echo "<html><body><form method=\"post\" action=\"adm_home.php\" name=\"frm_sistema\">";
	echo "<input type=\"hidden\" name=\"ss_id\" value=\"3\">";
	echo "<input type=\"hidden\" name=\"ss_nome\" value=\"Kanban\">";
	echo "</form>";
  	echo "<script>document.frm_sistema.submit();</script></body></html>";
  	exit();
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
<title>:: BAIXO ::</title>
<link href="include/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function acessar_sistema(x,y){
  document.frm_sistema.ss_id.value = x;
  document.frm_sistema.ss_nome.value = y;  
  document.frm_sistema.submit();
}
//-->
</script>
</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 text=white bgcolor=white background="<?echo $sys_conteudo_sp_url;?>images/mapa.jpg" bgproperties="FIXED">
<table align=center width="600" height="100%" cellpadding=0 cellspacing=0 border=0>
<tr><td width="100%" height="100%" align=center valign=middle>
<div align="center">
  <font face=Verdana size=2 color=black><b>Selecione o sistema que deseja acessar:</b></font>
<?
  // DISTINCT sys_acesso.sa_sg_id,
  $inst = "SELECT DISTINCT sys_sistema.ss_id, sys_sistema.* FROM sys_sistema, sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
  $inst .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' "; 
  $inst .= "   AND sys_usuario.su_status=1 ";
  $inst .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
  $inst .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
  $inst .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ORDER BY sys_sistema.ss_ordem ASC,sys_sistema.ss_nome ASC";
  $resu = mysql_query($inst);
  $contador = mysql_num_rows($resu);
  if ($contador==0){
     echo "<p><div align=center><font face=Verdana size=2 color=red><b>ATENÇÃO:</b> você não possui acesso em nenhum sistema!</font></div>";
  }
  $cont = 0;
  echo "<div align=center><table border=0 cellspacing=0 cellpadding=0 align=center>";
  while($valo=mysql_fetch_array($resu)){
     $url_sys = "javascript:acessar_sistema(".$valo["ss_id"].",'".$valo["ss_nome"]."');void(0);";
     if ($cont == 0){
        echo "<tr>";
        //echo "<td width=120 height=80 align=center valign=middle><a href=\"".$valo["ss_contexto"]."\" class=\"admmenu\"><img src=\"img_sys/id".$valo["ss_id"].".gif\" border=0><br>".$valo["ss_nome"]."</a></td>";
        echo "<td width=120 height=80 align=center valign=middle><a href=\"".$url_sys."\" class=\"admmenu\"><img src=\"img_sys/id".$valo["ss_id"].".gif\" border=0><br>".$valo["ss_nome"]."</a></td>";
        echo "<td width=20></td>";
        $cont = 1;
     } else if ($cont == 1){
        echo "<td width=120 height=80 align=center valign=middle><a href=\"".$url_sys."\" class=\"admmenu\"><img src=\"img_sys/id".$valo["ss_id"].".gif\" border=0><br>".$valo["ss_nome"]."</a></td>";
        echo "<td width=20></td>";
        $cont = 2;
     } else if ($cont == 2){
        echo "<td width=120 height=80 align=center valign=middle><a href=\"".$url_sys."\" class=\"admmenu\"><img src=\"img_sys/id".$valo["ss_id"].".gif\" border=0><br>".$valo["ss_nome"]."</a></td>";
        echo "<td width=20></td>";
        $cont = 3;
     } else if ($cont == 3){
        echo "<td width=120 height=80 align=center valign=middle><a href=\"".$url_sys."\" class=\"admmenu\"><img src=\"img_sys/id".$valo["ss_id"].".gif\" border=0><br>".$valo["ss_nome"]."</a></td>";
        echo "<td width=20></td>";
        $cont = 4;
     } else {
        echo "<td width=120 height=80 align=center valign=middle><a href=\"".$url_sys."\" class=\"admmenu\"><img src=\"img_sys/id".$valo["ss_id"].".gif\" border=0><br>".$valo["ss_nome"]."</a></td>";
        $cont = 0;
        echo "</tr>";
     }     
  }
  echo "</table></div>";
?>
<form method="post" action="adm_idx.php" name="frm_sistema">
<input type="hidden" name="ss_id" value="">
<input type="hidden" name="ss_nome" value="">
</form>
  <!--table border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td align=center valign=top><a href="admin_sys/" class="admmenu"><img src="img_sys/id1.gif" border=0><br>Administração</a></td><td width=20></td>
     <td align=center valign=top><a href="javascript:void(0);" class="admmenu"><img src="img_sys/id2.gif" border=0><br>Website</a></td><td width=20></td>
     <td align=center valign=top><a href="javascript:void(0);" class="admmenu"><img src="img_sys/id3.gif" border=0><br>Ouvidoria</a></td><td width=20></td>
     <td align=center valign=top><a href="javascript:void(0);" class="admmenu"><img src="img_sys/id4.gif" border=0><br>Acervo</a></td><td width=20></td>
     <td align=center valign=top><a href="javascript:void(0);" class="admmenu"><img src="img_sys/id5.gif" border=0><br>CAEF</a></td><td width=20></td>
   </tr>
  </table//-->
</div>
</tr>
</table>
<?
  include($sys_conteudo_sp_url."include/bottom.php");
?>
</body>
</html>
<? include ("include/bottom.php");?>