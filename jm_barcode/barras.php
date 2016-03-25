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

include ("code128.class.php");
//header("Content-type image/png");
//header ("Content-type: image/jpeg");

// FONTE PARA GERAR CÓDIGO DE BARRAS
$phpCode128 = new phpCode128($_REQUEST["suporte"],60, 'arial.ttf', 7);
$phpCode128->setBorderWidth(0);
$phpCode128->setBorderSpacing(2);
$phpCode128->setPixelWidth(1);
$phpCode128->setEanStyle(false);
$phpCode128->setShowText(true);
$phpCode128->setAutoAdjustFontSize(false);
$phpCode128->setTextSpacing(4);
//$phpCode128->getBarcode();
$phpCode128->getBarcodeJpeg();
?>