<? include ("include/header.php");?>

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
	<link href="include/custom_header.css" rel="stylesheet">
</head>
<body>
	<div id="header-wrapper" class="header-wrapper">
		<div id="header-content" class="header-content">
			<div class="header-content-login">
				<span style="color:white;">Usuário: <?=$_SESSION["ses_nome"]?></span><br>
				<span style="color:white;">Login: <?=$_SESSION["ses_login"]?></span><br>
				<? if (isset($_SESSION["ses_login"]) && in_array($_SESSION["ses_login"], array('jmuniz', 'mqueiroz', 'fsousa','dfonseca','rleme'))) : ?>
        			<span style="color:white;"><a href="baixo.php" target="Wnd_CONTEUDOSYS_Wnd_SYSbaixo">ADM</a></span>
        		<? endif ?>
			</div>
		</div>
	</div>
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
				echo $valor_apoio["sf_sf_id"];
				if ($contador==0){
					 $apoio_sql .= " AND (sys_ferramenta.sf_id=".$valo_apoio["sf_sf_id"];
				} else {
					 $apoio_sql .= " OR sys_ferramenta.sf_id=".$valo_apoio["sf_sf_id"];
				}
				$contador++;
		 }
		 $apoio_sql .= ") ";
	}
	$inst = "SELECT sys_ferramenta.*,sys_sistema.ss_contexto FROM sys_sistema,sys_ferramenta WHERE sys_ferramenta.sf_ss_id=3 AND sys_sistema.ss_id=3 AND sys_ferramenta.sf_id<>98 AND sys_ferramenta.sf_sf_id=0 AND sys_ferramenta.sf_status=1 " . $apoio_sql . " ORDER BY sys_ferramenta.sf_ordem ASC, sys_ferramenta.sf_sf_id ASC";
	$resu = mysql_query($inst);
	$cont = 0;
	while($valor=mysql_fetch_array($resu)){
		$cont++;
?>
		<li><a href="#" onMouseOver="HM_f_PopUp('elMenu<?echo $valor["sf_id"];?>',event)" onMouseOut="HM_f_PopDown('elMenu<?echo $valor["sf_id"];?>')"><?echo $valor["sf_nome"];?></a></li>
<?
	}
?>

<!--
<?
	if(($_SESSION["ses_tipo"]=="9") OR ($_SESSION["ses_tipo"]=="10")){
?>
	<li><a href="manual_agendamento_coletas_transp.pdf" target="_BLANK">Manual</a></li>
<? } else { ?>
	<li><a href="manual_agendamento_coletas_adm.pdf" target="_BLANK">Manual</a></li>
<? } ?>

-->
		<li><a href="login.php" target="Wnd_Sys_conteudo_principal">Sair</a></li>
	</ul>
	</div>

<SCRIPT LANGUAGE="JavaScript1.2"
				SRC="hr_menu/HM_LoaderFrames.js"
				TYPE='text/javascript'></SCRIPT>

</body>
</html>
<? include ("include/bottom.php");?>
