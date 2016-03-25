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

include('code128.class.php');
header ("Content-type: image/jpeg");
$barcode = new phpCode128($_GET['ticket'], 110, 'arial.ttf', 8);
$barcode->setBorderWidth(0);
$barcode->setBorderSpacing(10);
$barcode->setPixelWidth(1);
$barcode->setEanStyle(false);
$barcode->setShowText(true);
$barcode->setAutoAdjustFontSize(false);
$barcode->setTextSpacing(4);
$barcode->getBarcodeJpeg();
?>