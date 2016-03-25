<?php
$sys_conteudo_sp_url = "../../";
include($sys_conteudo_sp_url."verifica_sessao.php");

$objLst2 = new programacao();
$objLst2->filterRows .= " AND cpl_tipo = '0'";
$rowsLst2 = $objLst2->getCenario();
$objLst2->filterRows = "";
$objLst2->getParam();

$volume = number_format($objLst2->cpl_cumcol,0,",","."); 
$tempo = number_format($objLst2->cpl_tempo,0,",","."); 
$capacidade = number_format((($objLst2->cpl_cumcol/$objLst2->cpl_tempo)*$objLst2->cpp_capac),0,",","."); 
$capacidade_he = number_format(((($objLst2->cpl_cumcol/$objLst2->cpl_tempo)*$objLst2->cpp_capac)*$objLst2->cpp_capac_he),0,",",".");
$capacidade_si = number_format(((($objLst2->cpl_cumcol/$objLst2->cpl_tempo)*$objLst2->cpp_capac)*$objLst2->cpp_capac_si),0,",",".");
$objLst2->programacaoDBClose();
$objLst2 = NULL;

$staff = $_POST['cpl_staff'];
$staff_he = $_POST['cpl_staff_he'];
$staff_si = $_POST['cpl_staff_si'];
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
<title><? echo $titulo_pagina;?></title>
<link href="../../include/estilo.css" rel="stylesheet" type="text/css">
<!--meta http-equiv="refresh" content="30"//-->
<? include ("../../inc_javascript.php");?>
<script type="text/javascript" src="../../include/incjs.js"></script>
<script language="JavaScript">
<!--
//var intervalo = window.setInterval("atualiza()", 30000);
var intervalo2;

function campoCheck(camp)
{
    if (camp.length==0)
    {
        return false;
    } 
    else 
    {
        return true;
    }
}

function mudaCss(id,estilo)
{
    document.getElementById("cad"+id).className = estilo;
}

function atualiza() 
{
    history.go(0);
}
function voltar()
{
    location.href='index.php';
}

function verTA(x)
{
    if(x=="-1")
    {
	document.getElementById("trS").style.visibility = 'visible';
	document.getElementById("trS").style.position = 'relative';
    } 
    else 
    {
	document.getElementById("trS").style.visibility = 'hidden';
	document.getElementById("trS").style.position = 'absolute';
    }
}

function agendar()
{
    if (campoCheck (document.frm_busca.site.value)==false) 
    {
    	alert("Antes de agendar, você precisa selecionar o site no topo da página.");
    } 
    else 
    {
    	document.frm_busca.action='gera_disp.php';
		document.frm_busca.submit();
    }
}

function checklist()
{
    urlCk = "programacao_idx.php";
    abreChecklist(urlCk);
}

function calcular()
{
	document.frm_cadastro.valor.value = document.frm_cadastro.capacidade.value;  
	

}
function verificar()
{
   var erro="sem";
   campos="";
   if ((campoCheck (document.frm_cadastro.cpl_datjan.value)==false) ) 
   {
     erro="com";
     campos = campos + " \n -> Janela";
   }
   if ((campoCheck (document.frm_cadastro.cpl_staff.value)==false) ) 
   {
     erro="com";
     campos = campos + " \n -> Staff";
   }
   if ((campoCheck (document.frm_cadastro.cpl_staff_he.value)==false) ) 
   {
     erro="com";
     campos = campos + " \n -> Staff HE";
   }
   if ((campoCheck (document.frm_cadastro.cpl_staff_si.value)==false) ) 
   {
     erro="com";
     campos = campos + " \n -> Staff SI";
   }
   if (erro=="sem")
   {
		document.frm_cadastro.acao.value = "i";
        document.frm_cadastro.action = "aplicar.php";
        document.frm_cadastro.submit();
   } 
   else 
   {
     alert("Por favor preencha corretamente os campos:\n "+campos);
   }
}
//-->
</script>
</head>
<body bgcolor="white" text="#000000" link="#FF0000" vlink="#800000" alink="#FF00FF" marginwidth=20 marginheight=10 topmargin=10 leftmargin=20 background="<?echo $sys_conteudo_sp_url;?>images/mapa.jpg" bgproperties="FIXED" onLoad="javascript:document.frm_cadastro.cpl_datjan.focus();">
<form action="#" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="i">
<font face='verdana' color='red' size='2'><B>
<?php 
if (!empty($_REQUEST["mensagem"]))
{
    echo $_REQUEST["mensagem"];          
}
?>
</font>
<table border='0' cellpadding='0' cellspacing='0' width='100%' align='center'>
	<tr>
		<td colspan="4" align="center" height='10'></td>
	</tr>
    <tr align='center'><td id="home" valign='top'>
	<div align=center>
        <table border='0' cellpadding='0' cellspacing='0' align='center' width="60%">
            <tr><td width="100%" id='titulo_conc' valign='top' colspan='4' style='text-align: center'>Cenário da Operação</td></tr>
            <tr><td width="100%" colspan="4" align="center" height=5></td></tr>
            <tr>
                <td width="25%" id="label" valign=top>Volume</td><td width="25%" id="home" valign=top><?=$volume?></td>
                <td width="25%" id="label" valign=top>Capacidade</td><td width="25%" id="home" valign=top><?=$capacidade?></td>
            </tr>
            <tr>
                <td width="25%" id="label" valign=top>Horas</td><td width="25%" id="home" valign=top><?=$tempo?></td>
                <td width="25%" id="label" valign=top>Capacidade HE</td><td width="25%" id="home" valign=top><?=$capacidade_he?></td>
            </tr>
            <tr>
                <td width="25%" id="label" valign=top></td><td width="25%" id="home" valign=top></td>
                <td width="25%" id="label" valign=top>Capacidade SI</td><td width="25%" id="home" valign=top><?=$capacidade_si?></td>
            </tr>
			<tr>
				<td width='100%' height='1' colspan='10'><img src="../../images/gray1px.gif" width='100%' height='1' border='0'></td>
			</tr>
			<tr>
				<td colspan="4" align="center" height=20></td>
			</tr>
        </table>
    </div>
    </td>
    </tr>
</table>

<table border='0' cellpadding='2' cellspacing='0' align='center' width='31%' id="tipDiv">
	<tr>
		<td colspan="4" align="center" height='20'></td>
	</tr>
	<tr>
		<td valign=top id="home" >Janela</td>
		<td id="home" valign=top >
		<select name="cpl_datjan">
		<?php
			echo "<option value=\"\" style=\"color:silver;\">:: selecione ::</option>";
			$objLst1 = new programacao();
		    $objLst1->filterRows .= " AND cpl_status = 0";
		    $objLst1->filterRows .= " AND cpl_tipo = 0";	
			$rowsLst1 = $objLst1->listaJanela();
			$objLst1->programacaoDBClose();
			$objLst1 = NULL;
			foreach ($rowsLst1 as $key => $valor1)
			{
				if($valor1["cpl_id"]==$cpl)
				{
					$sel=" selected"; 
				}
				else
				{
					$sel="";
				}
				echo "<option value=\"".$valor1["cpl_datjan"]."\" $sel>".$valor1["cpl_datjan"]."</option>";
			}
		?>
		</select>
		</td>
	<tr>
		<td id="home">Pessoal</td>
		<td id="home"><input type="text" size=17 name="cpl_staff" value="<?echo $cpl_staff; ?>" onFocus="calcular()"></td>
	</tr>
	<tr>
		<td id="home">Pessoal HE</td>
		<td id="home"><input type="text" size=17 name="cpl_staff_he" value="0"></td>
	</tr>
	<tr>
		<td id="home">Pessoal SI</td>
		<td id="home"><input type="text" size=17 name="cpl_staff_si" value="0"></td>
	</tr>
	</tr>
	<tr>
		<td colspan="4" align="center" height='20'></td>
	</tr>
	<tr>
		<td width='100%' height='1' colspan='10'><img src="../../images/gray1px.gif" width='100%' height='1' border='0'></td>
	</tr>
	<tr>
		<td colspan="4" align="center" height=20><?=$valor?></td>
	</tr>
	<tr><td colspan="4" align="center" valign=middle height=30><input type="button" name=btn1 value="salvar" onClick="verificar()" id="input_btn_send"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
    include($sys_conteudo_sp_url."include/bottom.php");
?>