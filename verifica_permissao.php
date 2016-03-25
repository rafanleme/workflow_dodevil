<?
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

  $nome_dir = dirname($_SERVER["PHP_SELF"]);
  $nome_dir = explode("/",$nome_dir);
  $nome_dir_tool = $nome_dir[sizeof($nome_dir)-1];
  $nome_dir_sys = $nome_dir[sizeof($nome_dir)-2];


  //$inst_perm = "SELECT COUNT(*) FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
  $inst_perm = "SELECT sys_acesso.*,sys_ferramenta.sf_nome,sys_sistema.ss_nome FROM sys_ferramenta,sys_sistema,sys_acesso,sys_usuario,sys_usuario_rel_grupo WHERE  ";
  $inst_perm .= " sys_usuario.su_login='".$_SESSION["ses_login"]."' ";
  $inst_perm .= "   AND sys_usuario.su_status=1 ";
  $inst_perm .= "   AND sys_usuario_rel_grupo.surg_su_id=sys_usuario.su_id ";
  $inst_perm .= "   AND sys_usuario_rel_grupo.surg_sg_id=sys_acesso.sa_sg_id ";
  $inst_perm .= "   AND sys_sistema.ss_id=sys_acesso.sa_ss_id ";
  $inst_perm .= "   AND sys_ferramenta.sf_url='".$nome_dir_tool."/'";
  $inst_perm .= "   AND sys_ferramenta.sf_id=sys_acesso.sa_sf_id";
  $inst_perm .= "   AND sys_ferramenta.sf_status=1";
  $inst_perm .= "   AND sys_sistema.ss_contexto='".$nome_dir_sys."/'";
  $inst_perm .= "   ORDER BY sys_acesso.sa_tipo DESC";
  //echo $inst_perm;
  $resu_perm = mysql_query($inst_perm);
  $valo_perm = mysql_fetch_array($resu_perm);
  $tem_perm = mysql_num_rows($resu_perm);
  //$tem_perm = $valo_perm[0];
  $tipo_perm = $valo_perm["sa_tipo"];
  if ($valo_perm["sa_sf_sf_id"]>0){
    $inst_tool = "SELECT sf_nome FROM sys_ferramenta WHERE sf_id=".$valo_perm["sa_sf_sf_id"];
    $resu_tool = mysql_query($inst_tool);
    $valo_tool = mysql_fetch_array($resu_tool);
    if ($valo_tool["sf_nome"]!=$valo_perm["sf_nome"]){
    	$apoio_tool = $valo_tool["sf_nome"];
    }
  }
  //$valo_perm["ss_nome"].
  $titulo_tool = $apoio_tool." - ".$valo_perm["sf_nome"];
  if(($tem_perm=="0") OR ($tem_perm==0)){
     echo "<script language=\"JavaScript\">";
     echo "alert('Sistema de Agendamento\\n\\nVocê não possui acesso a essa ferramenta!');";
     echo "</script>";
     exit;
  }
?>