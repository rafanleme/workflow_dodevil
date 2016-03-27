<?php
/*#######################################################################
#............INFORMACAO.SOBRE.O.DESENVOLVIMENTO.E.A.CRIACAO.............#
#########################################################################
#.............................. Analista:....Juliano Muniz..............#
#.................................E-mail:....juliano.muniz@uol.com.br...#
#................................Celular:....(11) 8611-8004.............#
#.......................................................................#
#.............................. Analista:....Marcelo Queiroz............#
#.................................E-mail:....mqvida@yahoo.com.br........#
#................................Celular:....(11) 7288-3151.............#
#.......................................................................#
#.."BEM-AVENTURADO aquele que teme ao Senhor e anda nos seus caminhos...#
#..Pois comeras do trabalho das tuas maos; feliz seras, e te ira bem."..#
#...........................................* Salmo 128:1-2.............#
#######################################################################*/

include("../include/header.php");
$lfPos = 0;
?>
HM_Array34 = [
[170,      // menu width
<?php echo $lfPos;?>,   // left_position
0,   // top_position
"black",   // font_color
"black",   // mouseover_font_color
"#F4F4F4",   // background_color
"#D8D8FF",   // mouseover_background_color
"silver",   // border_color
"silver",    // separator_color
0,         // top_is_permanent
0,         // top_is_horizontal
0,         // tree_is_horizontal
0,         // position_under
1,         // top_more_images_visible
1,         // tree_more_images_visible
"null",    // evaluate_upon_tree_show
"null",    // evaluate_upon_tree_hide
],         // right_to_left
<?
    $inst3 = "SELECT DISTINCT sys_ferramenta.sf_id,sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
    $inst3 .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' ";
    $inst3 .= "   AND sys_usuario.su_status=1 ";
    $inst3 .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
    $inst3 .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
    $inst3 .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ";
    $inst3 .= "   AND sys_ferramenta.sf_ss_id=sys_sistema.ss_id";
    $inst3 .= "   AND sys_ferramenta.sf_id=sys_acesso.sa_sf_id";
    $inst3 .= "   AND sys_ferramenta.sf_status=1";
    $inst3 .= "   AND sys_ferramenta.sf_sf_id=34";
    $inst3 .= "   AND sys_sistema.ss_id=3";
    $inst3 .= "   ORDER BY sys_ferramenta.sf_ordem, sys_ferramenta.sf_nome";
    $resu3 = mysql_query($inst3);
    $cont3 = 0;
    while($valor3=mysql_fetch_array($resu3)){
    	  if($cont3>0){ echo ",\n";}
    	  echo "[\"&nbsp; ".$valor3["sf_nome"]."\",\"/workflow_dodevil/sys_base/".$valor3["sf_path"]."\",1,0,0]";
	  $cont3++;
    }
    if($cont3>0){
    	$lfPos += 130;
    }
?>
]

HM_Array36 = [
[170,      // menu width
<?php echo $lfPos;?>,   // left_position
0,   // top_position
"black",   // font_color
"black",   // mouseover_font_color
"#F4F4F4",   // background_color
"#D8D8FF",   // mouseover_background_color
"silver",   // border_color
"silver",    // separator_color
0,         // top_is_permanent
0,         // top_is_horizontal
0,         // tree_is_horizontal
0,         // position_under
1,         // top_more_images_visible
1,         // tree_more_images_visible
"null",    // evaluate_upon_tree_show
"null",    // evaluate_upon_tree_hide
],         // right_to_left
<?
    $inst3 = "SELECT DISTINCT sys_ferramenta.sf_id,sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
    $inst3 .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' ";
    $inst3 .= "   AND sys_usuario.su_status=1 ";
    $inst3 .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
    $inst3 .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
    $inst3 .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ";
    $inst3 .= "   AND sys_ferramenta.sf_ss_id=sys_sistema.ss_id";
    $inst3 .= "   AND sys_ferramenta.sf_id=sys_acesso.sa_sf_id";
    $inst3 .= "   AND sys_ferramenta.sf_status=1";
    $inst3 .= "   AND sys_ferramenta.sf_sf_id=36";
    $inst3 .= "   AND sys_sistema.ss_id=3";
    $inst3 .= "   ORDER BY sys_ferramenta.sf_ordem, sys_ferramenta.sf_nome";
    $resu3 = mysql_query($inst3);
    $cont3 = 0;
    while($valor3=mysql_fetch_array($resu3)){
    	  if($cont3>0){ echo ",\n";}
    	  echo "[\"&nbsp; ".$valor3["sf_nome"]."\",\"/workflow_dodevil/sys_base/".$valor3["sf_path"]."\",1,0,0]";
	  $cont3++;
    }
    if($cont3>0){
    	$lfPos += 130;
    }
?>
]


HM_Array37 = [
[170,      // menu width
<?php echo $lfPos;?>,   // left_position
0,   // top_position
"black",   // font_color
"black",   // mouseover_font_color
"#F4F4F4",   // background_color
"#D8D8FF",   // mouseover_background_color
"silver",   // border_color
"silver",    // separator_color
0,         // top_is_permanent
0,         // top_is_horizontal
0,         // tree_is_horizontal
0,         // position_under
1,         // top_more_images_visible
1,         // tree_more_images_visible
"null",    // evaluate_upon_tree_show
"null",    // evaluate_upon_tree_hide
],         // right_to_left
<?
    $inst3 = "SELECT DISTINCT sys_ferramenta.sf_id,sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
    $inst3 .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' ";
    $inst3 .= "   AND sys_usuario.su_status=1 ";
    $inst3 .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
    $inst3 .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
    $inst3 .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ";
    $inst3 .= "   AND sys_ferramenta.sf_ss_id=sys_sistema.ss_id";
    $inst3 .= "   AND sys_ferramenta.sf_id=sys_acesso.sa_sf_id";
    $inst3 .= "   AND sys_ferramenta.sf_status=1";
    $inst3 .= "   AND sys_ferramenta.sf_sf_id=37";
    $inst3 .= "   AND sys_sistema.ss_id=3";
    $inst3 .= "   ORDER BY sys_ferramenta.sf_ordem, sys_ferramenta.sf_nome";
    $resu3 = mysql_query($inst3);
    $cont3 = 0;
    while($valor3=mysql_fetch_array($resu3)){
    	  if($cont3>0){ echo ",\n";}
    	  echo "[\"&nbsp; ".$valor3["sf_nome"]."\",\"/workflow_dodevil/sys_base/".$valor3["sf_path"]."\",1,0,0]";
	  $cont3++;
    }
    if($cont3>0){
    	$lfPos += 130;
    }
?>
]
