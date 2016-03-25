<?php
$sys_conteudo_sp_url = "../../";
include($sys_conteudo_sp_url."verifica_sessao.php");

error_reporting (0);
//error_reporting (E_ALL);
?>
<html>
<head>
<title><? echo $titulo_pagina;?></title>
<link href="../../include/estilo.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../../include/incjs.js"></script>
<?php include ("../../inc_javascript.php");?>
<!--script language="JavaScript" src="../../JSClass/FusionCharts.js"></script>
<script language="JavaScript" src="../../JSClass/FusionChartsExportComponent.js"></script//-->

<script language="JavaScript">
<!--
function calGridPed(){
	document.getElementById("divAjax").innerHTML = "aguarde...";
	var data = document.getElementById('frmData').value;
	//var codpro = document.getElementById('codpro').value;
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("divAjax").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "gridPed.php?data=" + data, true);
  xhttp.send();
}

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

function deletar(x)
{
  if (confirm("Deseja excluir esse Planejamento?"))
  {
		document.form1.acao.value = "d";
  		document.form1.cpl_datjan.value = x;	
        document.form1.action = "aplicar.php";
        document.form1.submit();
  }
}

function editar(x)
{
    if (confirm("Deseja validar TODOS os planejamentos?"))
    {
        document.form1.acao.value = "e";
  		document.form1.cpl_id.value = x;	
        document.form1.action = "aplicar.php";
        document.form1.submit();
    }
}

function mudaCss(id,estilo)
{
  document.getElementById("cad"+id).className = estilo;
}

function verificar()
{
   var erro="sem";
   campos="";
   if ((campoCheck (document.form1.frmData.value)==false) ) 
   {
	   erro="com";
	   campos = campos + " \n -> Data";
   }
   
   if (erro=="sem")
   {
	   document.form1.target = "";
       document.form1.action = "index.php";
       document.form1.submit();
   } 
   else 
   {
	   alert("Por favor preencha corretamente os campos:\n "+campos);
   }
}
-->
</script>
</head>
<body>
<table border="0" cellpadding="1" cellspacing="2" width="100%">
<tr>
  <td id="titulo2"><b><i><?echo $titulo_tool;?><i></b></td>
</tr>
<tr>
  <td HEIGHT="1" BGCOLOR="#BF302A"></td>
</tr>
</table>
<font face="verdana" color="red" size="2"><B>
<?php 
if (!empty($_REQUEST["mensagem"]))
{
    echo $_REQUEST["mensagem"];
}
?>
</b></font><p>
<form action="index.php" method="post" name="form1">
<input type="hidden" name="acao" value="b">
<input type="hidden" name="cpl_datjan" value="">

<hr/>
<div id="divAjax">
	
</div>
</form>
</body>
</html>
<?
 include($sys_conteudo_sp_url."include/bottom.php");
?>