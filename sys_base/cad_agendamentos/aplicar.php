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

$sys_conteudo_sp_url = "../../";
include($sys_conteudo_sp_url."verifica_sessao.php");
if ($tipo_perm=="R")
{
	$mensagem="Voce nao tem permissao para alterar o cadastro.";
	echo "<script language=\"JavaScript\">";
	echo "   var page = \"index.php?mensagem=".$mensagem."\";";
	echo "   location.href=page;";
	echo "</script>";
	exit;
}

$mensagem="";

$objSet = new programacao();
//$objSet->cpl_id = $cpl_id;
$objSet->cpl_staff = $cpl_staff;
$objSet->cpl_staff_he = $cpl_staff_he;
$objSet->cpl_staff_si = $cpl_staff_si;
$objSet->cpl_datjan = $_POST['cpl_datjan'];

if ($acao=="i")
{
	$objSet->setProgramacao();
	$mensagem = "Planejamento inserido com sucesso!";
	$varpage = "programacao_idx.php";
}
else if ($acao=="d")
{
	$objSet->remProgramacao();
	$mensagem = "Planejamento excluído com sucesso!";
	$varpage = "index.php";	
}
else if ($acao=="e")
{
	$objSet->valProgramacao();
	$mensagem = "Planejamento validado com sucesso!";
	$varpage = "index.php";	
}

if($objCad->erro)
{
	$mensagem= "<b>Ocorreu um erro, contate o administrador.</b>";
	echo $mensagem;
} 
else 
{
	echo "<script language=\"JavaScript\">";
	echo "   var page = \"".$varpage."?&mensagem=".$mensagem."&cli_id=".$objSet->cli_id."\";";
	echo "   location.href=page;";
	echo "</script>";
}

$objSet->programacaoDBClose();
$objSet = NULL;
?>
<?php include ($sys_conteudo_sp_url."bottom.php");?>