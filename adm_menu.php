<?
  $sys_conteudo_sp_url = "";
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
<link href="include/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function abre_fecha(qual){
  var block;
  block = eval( "document.all.divMenu" + qual );
  block.style.display = (block.style.display == "none") ? "" : "none";
}
//-->
</script>
</head>
<body bgcolor="#E6E7E9" text="#000000" link="#FF0000" vlink="#800000" alink="#FF00FF" marginwidth=0 marginheight=0 topmargin=0 leftmargin=0>
<table border=0 cellpadding=0 cellspacing=0 align=left width=122 bgcolor="#E6E7E9"><tr>
<td id="home3_adm" bgcolor="#E6E7E9">

<table border=0 cellpadding=0 cellspacing=0 width=100% bgcolor=white>
<!--tr class="lktb_menu_tit"><td width=100%><a href="adm_home.php" class="lk_menu_tit" target="CONTEUDO_Bdm_home"><b><?echo $ses_ss_nome;?></b></a></td></tr>
<tr><td width=100%><img src="images/bg_padrao.jpg" border=0 width=100% height=1></td></tr//-->
<?
  $inst_apoio = "SELECT DISTINCT sys_ferramenta.sf_sf_id FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
  $inst_apoio .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' "; 
  $inst_apoio .= "   AND sys_usuario.su_status=1 ";
  $inst_apoio .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
  $inst_apoio .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
  $inst_apoio .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ";
  $inst_apoio .= "   AND sys_ferramenta.sf_ss_id=sys_sistema.ss_id";
  $inst_apoio .= "   AND sys_ferramenta.sf_id=sys_acesso.sa_sf_id";
  $inst_apoio .= "   AND sys_ferramenta.sf_status=1";
  $inst_apoio .= "   AND sys_sistema.ss_id=".$_SESSION["ses_ss_id"];
  $inst_apoio .= "   ORDER BY sys_ferramenta.sf_ordem ASC, sys_ferramenta.sf_nome ASC";
  $resu_apoio = mysql_query($inst_apoio);
  $cont_apoio = mysql_num_rows($resu_apoio);
  if ($cont_apoio>0){
     $contador = 0;
     $apoio_sql = "";
     while ($valo_apoio=mysql_fetch_array($resu_apoio)){
        if ($contador==0){
           $apoio_sql .= " AND (sys_ferramenta.sf_id=".$valo_apoio["sf_sf_id"];
        } else {
           $apoio_sql .= " OR sys_ferramenta.sf_id=".$valo_apoio["sf_sf_id"];
        }
        $contador++;
     }
     $apoio_sql .= ") ";
  }  
  //$inst = "SELECT sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_sistema,sys_ferramenta WHERE sys_ferramenta.sf_ss_id=".$ses_ss_id." AND sys_sistema.ss_id=".$ses_ss_id." AND sys_ferramenta.sf_sf_id=0 ORDER BY sys_ferramenta.sf_sf_id ASC";
  $inst = "SELECT sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_sistema,sys_ferramenta WHERE sys_ferramenta.sf_ss_id=".$_SESSION["ses_ss_id"]." AND sys_sistema.ss_id=".$_SESSION["ses_ss_id"]." AND sys_ferramenta.sf_sf_id=0 ".$apoio_sql." ORDER BY sys_ferramenta.sf_sf_id ASC";
  $resu = mysql_query($inst);
  $cont = 0;
  while($valor=mysql_fetch_array($resu)){
    $cont++;
    //echo "<tr><td height=10></tr>";
    //echo "<tr class=\"lktb_menu\"><td><a href=\"javascript:abre_fecha(".$cont.");\" class=\"lk_menu\"><b>".$valor["sf_nome"]."</b></a></td></tr>";
    echo "<tr><td>";
    echo "<div id=\"divMenu".$cont."\" style=\"display: ;\">";
    echo "<table border=0 cellpadding=0 cellspacing=0 width=100%>";
    //$inst2 = "SELECT sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_sistema,sys_ferramenta WHERE sys_ferramenta.sf_ss_id=".$ses_ss_id." AND sys_sistema.ss_id=".$ses_ss_id." AND sys_ferramenta.sf_sf_id=".$valor["sf_id"]." ORDER BY sf_sf_id ASC";
    $inst2 = "SELECT DISTINCT sys_ferramenta.sf_id,sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
    $inst2 .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' "; 
    $inst2 .= "   AND sys_usuario.su_status=1 ";
    $inst2 .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
    $inst2 .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
    $inst2 .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ";
    $inst2 .= "   AND sys_ferramenta.sf_ss_id=sys_sistema.ss_id";
    $inst2 .= "   AND sys_ferramenta.sf_id=sys_acesso.sa_sf_id";
    $inst2 .= "   AND sys_ferramenta.sf_status=1";
    $inst2 .= "   AND sys_ferramenta.sf_sf_id=".$valor["sf_id"];
    $inst2 .= "   AND sys_sistema.ss_id=".$_SESSION["ses_ss_id"];
    $inst2 .= "   ORDER BY sys_ferramenta.sf_nome";
    $resu2 = mysql_query($inst2);
    while($valor2=mysql_fetch_array($resu2)){
       $url_sf = $valor2["ss_contexto"].$valor2["sf_url"];
       echo "<tr><td height=1></tr>";
       echo "<tr class=\"lktb_submenu\"><td valign=center><a href=\"".$url_sf."\" target=\"CONTEUDO_Bdm_home\" class=\"lk_submenu\"> &nbsp; ".$valor2["sf_nome"]."</a></td></tr>";
    }
    echo "<tr><td height=1></tr>";
    echo "</table></div>";
    echo "</td></tr>";

  }
?>
</table>

</td>
</tr></table>

</body>
</html>
<? include ("include/bottom.php");?>