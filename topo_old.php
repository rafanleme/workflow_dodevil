<? include ("include/header.php");?>
<?
$_SESSION["ses_transportadora"] = $_SESSION["ses_transportadora_certa"];
$_SESSION["ses_transportadora_cnpj"] = $_SESSION["ses_transportadora_cnpj_certo"];
?>
<!--
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
//-->

<html>
<head>
<title>:: TOPO ::</title>
<link href="include/estilo.css" rel="stylesheet" type="text/css">


<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
if(window.event + "" == "undefined") event = null;
function HM_f_PopUp(){return false};
function HM_f_PopDown(){return false};
popUp = HM_f_PopUp;
popDown = HM_f_PopDown;
//-->
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript1.2" TYPE="text/javascript">
<!--

HM_PG_MenuWidth = 130;
HM_PG_FontFamily = "Arial,sans-serif";
HM_PG_FontSize = 9;
HM_PG_FontBold = 0;
HM_PG_FontItalic = 0;
HM_PG_FontColor = "black";
HM_PG_FontColorOver = "black";
HM_PG_BGColor = "#DDDDDD";
HM_PG_BGColorOver = "#D8D8FF";
HM_PG_ItemPadding = 2;

HM_PG_BorderColor = "silver";
HM_PG_BorderStyle = "solid";
HM_PG_SeparatorSize = 1;
HM_PG_SeparatorColor = "silver";

HM_PG_ImageSrc = "HM_More_black_right.gif";
HM_PG_ImageSrcLeft = "HM_More_black_left.gif";
HM_PG_ImageSrcOver = "HM_More_white_right.gif";
HM_PG_ImageSrcLeftOver = "HM_More_white_left.gif";
HM_PG_ImageSize = 5;
HM_PG_ImageHorizSpace = 0;
HM_PG_ImageVertSpace = 2;

HM_PG_KeepHilite = 1;
HM_PG_ClickStart = 0;
HM_PG_ChildOverlap = 20;
HM_PG_ChildOffset = 10;
HM_PG_ChildPerCentOver = null;
HM_PG_StatusDisplayBuild = 1;
HM_PG_StatusDisplayLink  = 1;
HM_PG_TopSecondsVisible = .5;
HM_PG_UponDisplay = null;
HM_PG_UponHide = null;
HM_PG_RightToLeft = 1;

HM_PG_ShowLinkCursor = 1;
HM_PG_NSFontOver = true;

HM_PG_ScrollBarColor = "lightgrey";
HM_PG_ScrollImgSrcTop = "HM_More_black_top.gif";
HM_PG_ScrollImgSrcBot = "HM_More_black_bot.gif";
HM_PG_ScrollImgWidth = 9;
HM_PG_ScrollImgHeight = 5;

HM_PG_FramesEnabled = true;
HM_PG_FramesNavFramePos = "bottom";
HM_PG_FramesMainFrameName = "Wnd_CONTEUDOSYS_Wnd_SYSbaixo";

//-->
</SCRIPT>



</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 text=white bgcolor=black>
<table align=left width="100%" height="80" cellpadding=0 cellspacing=0 border=0  background="images/topo_bg.jpg">
<tr><td width="800" align=left valign=top>

  <table border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td width=210></td>
    <td width=420 valign=top><div style="height:28px;"></div>
      <font color=white size=1 face=Verdana>
      <b>Usuário:</b> <? echo $_SESSION["ses_login"]; ?><br><b>Nome:</b> <? echo $_SESSION["ses_nome"]; ?><br>
      <?
      	$objCad = new empresa();
      	$objCad->ce_id = $_SESSION["ses_transportadora"];
      	$objCad->getCad();
      	echo $objCad->ce_razao."&nbsp;";
      	$objCad->DBClose();
      	unset($objCad);
      ?>
      </font>
    </td>
    <td width=200>
      <div align=right>
      <font color=white size=1 face=Verdana>
      <? if ($_SESSION["ses_login"]=="jmuniz" || $_SESSION["ses_login"]=="mqueiroz"){ ?>
        <a href="baixo.php" target="Wnd_CONTEUDOSYS_Wnd_SYSbaixo"><img src="images/btn_sis_24.png" border=0 alt="Entrar em outro sistema" width=2 height=2></a>
        &nbsp;

        <!--a href="login.php" target="Wnd_Sys_conteudo_principal"><img src="images/btn_exit_24.png" border=0 alt="Sair do sistema"></a//-->
        &nbsp; &nbsp;
      <? } ?>
      </font>
      </div>
    </td>
    <td width=8></td>
   </tr>
  </table>
</td>
</tr>
<tr><td colspan=10 height=15></td></tr>
<tr>
  <td colspan=10 height=20>
	<div id="menu">
	<ul>
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
  $inst_apoio .= "   AND sys_sistema.ss_id=3";
  $inst_apoio .= "   AND sys_ferramenta.sf_id<>98";
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
  $inst = "SELECT sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_sistema,sys_ferramenta WHERE sys_ferramenta.sf_ss_id=3 AND sys_sistema.ss_id=3 AND sys_ferramenta.sf_id<>98 AND sys_ferramenta.sf_sf_id=0 AND sys_ferramenta.sf_status=1 ".$apoio_sql." ORDER BY sys_ferramenta.sf_ordem ASC, sys_ferramenta.sf_sf_id ASC";
  $resu = mysql_query($inst);
  $cont = 0;
  while($valor=mysql_fetch_array($resu)){
    $cont++;
?>
		<li><a href="#" onMouseOver="HM_f_PopUp('elMenu<?echo $valor["sf_id"];?>',event)" onMouseOut="HM_f_PopDown('elMenu<?echo $valor["sf_id"];?>')"><?echo $valor["sf_nome"];?></a></li>
<?
  }
?>

		<li><a href="login.php" target="Wnd_Sys_conteudo_principal">Sair</a></li>
	</ul>
	</div>
  </td>
</tr>
</table>

<SCRIPT LANGUAGE="JavaScript1.2"
        SRC="/eponderal_nivea/hr_menu/HM_LoaderFrames.js"
        TYPE='text/javascript'></SCRIPT>

</body>
</html>
<? include ("include/bottom.php");?>
