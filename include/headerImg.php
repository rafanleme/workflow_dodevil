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

set_time_limit(2400);

////////////////////////////////////////////////////////////
// CARREGA CONFIGURACAO DO SITE E DO MYSQL
////////////////////////////////////////////////////////////
  if (file_exists("config.php")){
    include("config.php");
  } else if (file_exists("include/config.php")){
    include("include/config.php");
  } else if (file_exists("../include/config.php")){
    include("../include/config.php");
  } else if (file_exists("../../include/config.php")){
    include("../../include/config.php");
  } else if (file_exists("../../../include/config.php")){
    include("../../../include/config.php");
  } else if (file_exists("../../admintranet/include/config.php")){
    include("../../admintranet/include/config.php");
  }
  
  
function __autoload($class_name) {
	//if ($class_name=="dbConn"){ $class_name = "../../include/".$class_name;}
	//if ($class_name=="db2Conn"){ $class_name = "../../include/".$class_name;}
	//if ($class_name=="functions"){ $class_name = "../../include/".$class_name;}
	$classe = $GLOBALS["sys_conteudo_sp_url"]."class/".$class_name.".class.php";
	require_once $classe;
}


?>
