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

//die("Aguarde, estamos realizando ajustes no sistema.");
////////////////////////////////////////////////////////////
// CONTROLE DE GRAVACAO DO SITE EM CACHE DO BROWSER
////////////////////////////////////////////////////////////
  //<meta http-equiv="Expires" content="0">
  //<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
  //<meta http-equiv="Pragma" content="no-cache">
  $hora_inicio_script = microtime();
//  header("Pragma: no-cache");
//  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//  header("Cache-Control: no-store, no-cache, must-revalidate");
//  header("Cache-Control: post-check=1, pre-check=1, true");
  error_reporting (E_ERROR|E_PARSE);
  //error_reporting (E_ALL);
  set_time_limit(2400);
  //flush();

session_start("SYS_CONTEUDO");
session_name("SYS_CONTEUDO");

if(!isset($GLOBALS["interface"])){
	$ses_login = $_SESSION["ses_login"];
	$ses_nome = $_SESSION["ses_nome"];
	$ses_senha = $_SESSION["ses_senha"];
	$ses_ok = $_SESSION["ses_ok"];
	$ses_id = $_SESSION["ses_id"];
	$ses_ss_id = $_SESSION["ses_ss_id"];
	$ses_ss_nome = $_SESSION["ses_ss_nome"];
}


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
  }

function __autoload($class_name) {
	//if ($class_name=="dbConn"){ $class_name = "../../include/".$class_name;}
	//if ($class_name=="db2Conn"){ $class_name = "../../include/".$class_name;}
	//if ($class_name=="functions"){ $class_name = "../../include/".$class_name;}
	$classe = $GLOBALS["sys_conteudo_sp_url"]."class/".$class_name.".class.php";
	require_once $classe;
}

////////////////////////////////////////////////////////////
// INTERFACE DE CONEXAO DO PHP COM O MYSQL
////////////////////////////////////////////////////////////
  $conexao = mysql_connect($host,$user,$pass,$conexao,MYSQL_CLIENT_COMPRESS) or die("<FONT face=arial COLOR=RED><b>ERRO COM CONEXÃO</b><p><font color=black>O servidor de banco de dados não pode ser localizado ou não existe.</font></FONT>");
//$conexao = mysql_pconnect(sqlHOST,sqlUSER,sqlPASS);
//mysql_select_db(sqlDATA,$conexao);
	
  mysql_select_db($database,$conexao) or die("<FONT face=arial COLOR=RED><b>ERRO COM BANCO DE DADOS</b><p><font color=black>O banco de dados não pode ser localizado ou não existe.</font></FONT>");

////////////////////////////////////////////////////////////
// INTERFACE DE CONEXAO DO PHP COM O LDAP
////////////////////////////////////////////////////////////
 // $conexao_ldap = ldap_connect($host_ldap,"389") or die("<FONT face=arial COLOR=RED><b>ERRO COM CONEXÃO</b><p><font color=black>O servidor de ldap não pode ser localizado ou não existe.</font></FONT>");

////////////////////////////////////////////////////////////
// CONTAGEM DE USUARIOS ONLINE
////////////////////////////////////////////////////////////
//  user_online();


////////////////////////////////////////////////////////////
// FUNCOES PRONTAS
////////////////////////////////////////////////////////////

function calcularData($data,$addHoras)
{
	$ano = date('Y',strtotime($data));
	$mes = date('m',strtotime($data));
	$dia = date('d',strtotime($data));
	$hora = date('H',strtotime($data))+$addHoras;
	$minutos = date('i',strtotime($data));
	$segundos = date('s',strtotime($data));
	return date('Y-m-d H:i:s',mktime($hora,$minutos,$segundos,$mes,$dia,$ano));
}

function ultimoDiaMes($anomes){
	$ano = substr($anomes,0,4);
	$mes = substr($anomes,5,2);
	$dia = 0;
	for($d=1;$d<32;$d++){
		if(checkdate($mes,$d,$ano)){
			$dia = $d;
		} else {
			break;
		}
	}
	if(strlen($dia)==1){
		$dia = "0".$dia;
	}
	return $dia;
}

function tiraMascara($str)
{
	$nstr = str_replace("\\","",$str);
	$nstr = str_replace("/","",$str);
	$nstr = str_replace(".","",$nstr);
	$nstr = str_replace("-","",$nstr);
	return $nstr;
}


function FormatNumber($number, $decimals = 0, $thousand_separator = '&nbsp;', $decimal_point = '.') 
{
	$tmp1 = round((float) $number, $decimals);
	while (($tmp2 = preg_replace('/(\d+)(\d\d\d)/', '\1 \2', $tmp1)) != $tmp1)
    $tmp1 = $tmp2;
	return strtr($tmp1, array(' ' => $thousand_separator, '.' => $decimal_point));
}

function decimal2c($nb)
{
	return number_format(doubleval($nb),2,".","") ;
	//return FormatNumber(doubleval($nb),2,"",".") ;
}

function getFormatoNumero($numeroFnc,$tipoFnc)
{
	$tipoFnc = trim($tipoFnc);
	$num = doubleval($numeroFnc);
	if($tipoFnc=="kg"){ $num = number_format($num,2,".","");}
	if($tipoFnc=="g"){ $num = number_format($num,2,".","");}
	if($tipoFnc=="lb"){ $num = number_format($num,2,".","");}
	if($tipoFnc=="pal"){ $num = number_format($num,0,".","");}
	if($tipoFnc=="un"){ $num = number_format($num,0,".","");}
	if($tipoFnc=="cx"){ $num = number_format($num,0,".","");}
	if($tipoFnc=="m"){ $num = number_format($num,2,".","");}
	if($tipoFnc=="m3"){ $num = number_format($num,2,".","");}
	if($tipoFnc=="pc"){ $num = number_format($num,0,".","");}
	if($tipoFnc=="ml"){ $num = number_format($num,2,".","");}
	if($tipoFnc=="l"){ $num = number_format($num,2,".","");}
	return $num;
}

function tiraAcento($texto)
{
	$a = array("/[ÂÀÁÄÃ]/"=>"A","/[âãàáä]/"=>"a","/[ÊÈÉË]/"=>"E","/[êèéë]/"=>"e","/[ÎÍÌÏ]/"=>"I","/[îíìï]/"=>"i","/[ÔÕÒÓÖ]/"=>"O","/[ôõòóö]/"=>"o","/[ÛÙÚÜ]/"=>"U","/[ûúùü]/"=>"u","/ç/"=>"c","/Ç/"=> "C");
    return preg_replace(array_keys($a), array_values($a), $texto);
}

function pegaUnidade($tipoFnc)
{
	$lst_unidade[1] = "g";
	$lst_unidade[2] = "kg";
	$lst_unidade[3] = "lb";
	$lst_unidade[4] = "pal";
	$lst_unidade[5] = "un";
	$lst_unidade[6] = "cx";
	$lst_unidade[7] = "m";
	$lst_unidade[8] = "m3";
	$lst_unidade[9] = "pc";
	$lst_unidade[10] = "ml";
	$lst_unidade[11] = "l";
	return $lst_unidade[$tipoFnc];
}

function fillStr($tipo,$str,$qtd)
{
	$strRetorno = "";
    if (strlen($str)<$qtd)
	{
		$strRetorno = $str;
        for ($i=strlen($str); $i < $qtd; $i++) 
		{
             if ($tipo=="i")
			 {
                 $strRetorno = "0".$strRetorno;
             } else if ($tipo=="s")
			 {
                 $strRetorno = $strRetorno." ";
             }
         }
     } 
	 else if (strlen($str)>$qtd)
	 {
         $strRetorno = substr($str,0,$qtd);
     } 
	 else 
	 {
         $strRetorno = $str;
     }
     return $strRetorno;
}

function user_online()
{
	$timestamp=time();
    $timeout=time()-300;
    if ((!empty($GLOBALS["ses_prontuario"])) AND (!empty($GLOBALS["ses_prontuario"])))
	{
        $result=mysql_query("INSERT INTO sys_usuario_online VALUES ('$timestamp','".$GLOBALS["REMOTE_ADDR"]."','".$GLOBALS["PHP_SELF"]."','".$GLOBALS["ses_nome"]."','".$GLOBALS["ses_prontuario"]."')");
    }
    $result=mysql_query("DELETE FROM sys_usuario_online WHERE hora<$timeout");
    $result=mysql_query("SELECT DISTINCT suo_nome FROM sys_usuario_online ORDER BY suo_hora DESC");
}

  function users_online(){
     $timeout=time()-300;
     $result=mysql_query("DELETE FROM sys_usuario_online WHERE suo_hora<$timeout");
     $result=mysql_query("SELECT DISTINCT suo_nome FROM sys_usuario_online ORDER BY suo_hora DESC");
     $cont = mysql_num_rows($result);
     $str = "";
     while($valor=mysql_fetch_array($result)){
        $str .= $valor[suo_nome]."; ";
     }
     return $str;
  }

  function img_resolucao($fnc_arq){
     $img_old = imagecreatefromjpeg($fnc_arq);
     $width = imagesx($img_old);
     $height = imagesy($img_old);
     if ($width>$height){
       if ($width>1000){$res="h";} else {$res="l";}
     } else if ($width==$height){
       if ($width>1000){$res="h";} else {$res="l";}
     } else {
       if ($height>1000){$res="h";} else {$res="l";}
     }
     return $res;
  }

  function dtbarra2dthifen($dt_fnc){
    if ($dt_fnc<>""){
      $datacerta1 = substr($dt_fnc,0,2);
      $datacerta2 = substr($dt_fnc,3,2);
      $datacerta3 = substr($dt_fnc,6,4);
      return "$datacerta3-$datacerta2-$datacerta1";
    }
  }

  function dthifen2dtbarra($dt_fnc){
    if ($dt_fnc<>""){
      $datacerta1 = substr($dt_fnc,8,2);
      $datacerta2 = substr($dt_fnc,5,2);
      $datacerta3 = substr($dt_fnc,0,4);
      return "$datacerta1/$datacerta2/$datacerta3";
    }
  }

  function dtbarra2dtas400($dt_fnc){
    if ($dt_fnc<>""){
      $datacerta1 = substr($dt_fnc,0,2);
      $datacerta2 = substr($dt_fnc,3,2);
      $datacerta3 = substr($dt_fnc,6,4);
      return "$datacerta3$datacerta2$datacerta1";
    }
  }

  function dtas4002dtbarra($dt_fnc){
    if ($dt_fnc<>""){
      $datacerta1 = substr($dt_fnc,6,2);
      $datacerta2 = substr($dt_fnc,4,2);
      $datacerta3 = substr($dt_fnc,0,4);
      return "$datacerta1/$datacerta2/$datacerta3";
    }
  }

  function dtas4002dthifen($dt_fnc){
    if ($dt_fnc<>""){
      $datacerta1 = substr($dt_fnc,6,2);
      $datacerta2 = substr($dt_fnc,4,2);
      $datacerta3 = substr($dt_fnc,0,4);
      return "$datacerta3-$datacerta2-$datacerta1";
    }
  }

  function horaas400($h){
  	$inv = strrev($h);
  	$nh = substr($inv,0,2).":".substr($inv,2,2).":".substr($inv,4,2);
  	$nh = strrev($nh);
    return $nh;
  }

  function as400TipoMotivo($vl){
    switch($vl){
		case 10:
			return "Carga Inicial";
		case 20:
			return "Rotativo";
		case 30:
			return "Transferência";
		case 40:
			return "Carga Inicial";
		case 50:
			return "Recepção";
	}
  }

  function as400Motivo($vl){
    switch($vl){
		case "STI+":
			return "CI";
		case "EA+":
			return "EA";
		case "OBS+":
			return "CI";
		case "SA-":
			return "SA";
		case "15-":
			return "CI";
		case "15+":
			return "CI";
		case "18-":
			return "ST";
		case "18+":
			return "ET";
		case "19-":
			return "ST";
		case "19+":
			return "ET";
		case "*RS+":
			return "EE";
		case "*RD-":
			return "RD";
		case "999-":
			return "Ajuste sem subida";
		case "999+":
			return "Ajuste sem subida";
		case "20-":
			return "Transferencia interna";
		case "20+":
			return "Transferencia interna";
		case "21-":
			return "Transferencia interna";
		case "21+":
			return "Transferencia interna";
		case "AG-":
			return "Aglutinação de produto";
		case "AG+":
			return "Aglutinação de produto";
		case "15-":
			return "Regularização de Inventário";
		case "15+":
			return "Regularização de Inventário";
	}
  }

  function verdata($dt_fnc){
    $datacerta1 = substr($dt_fnc,0,2);
    $datacerta2 = substr($dt_fnc,3,2);
    $datacerta3 = substr($dt_fnc,6,4);
    if (checkdate($datacerta2,$datacerta1,$datacerta3)==true){
      return "true";
    } else {
      return "false";
    }
   }

  function vervazio($str_fnc){
    $str_fnc = nl2br(strip_tags($str_fnc));
    if (empty($str_fnc)){
      return "-";
    } else {
      return $str_fnc;
    }
   }

  function verlnkmail($str_fnc){
    $str_fnc = nl2br(strip_tags($str_fnc));
    if (empty($str_fnc)){
      return "-";
    } else {
      return "$str_fnc <a href=\"mailto:$str_fnc\"><img align=top src=\"images/email.gif\" border=0 alt=\"Enviar um e-mail!\"></a>";
    }
   }

  function verlnkweb($str_fnc){
    $str_fnc = nl2br(strip_tags($str_fnc));
    if (empty($str_fnc)){
      return "-";
    } else {
      return "<a href=\"$str_fnc\" target=\"_blank\">$str_fnc</a>";
    }
   }

  function verlnkicq($str_fnc){
    $str_fnc = nl2br(strip_tags($str_fnc));
    if (empty($str_fnc)){
      return "-";
    } else {
      return "$str_fnc <a href=\"http://wwp.icq.com/scripts/search.dll?to=$str_fnc\" target=\"_blank\"><img align=top src=\"http://web.icq.com/whitepages/online?icq=$str_fnc&img=21\" border=0 alt=\"Adicionar na minha lista!\"></a>";
    }
   }

  function pega2nome($str_fnc){
    $strs_fnc = explode(" ",$str_fnc);
    $nome2 = "$strs_fnc[0]";
    return $nome2;
  }

  function traduz_dia_semana($nome_dia_en){
    switch($nome_dia_en){
      case "Sunday":
        return "Domingo";
      case "Monday":
        return "Segunda-feira";
      case "Tuesday":
        return "Terça-feira";
      case "Wednesday":
        return "Quarta-feira";
      case "Thursday":
        return "Quinta-feira";
      case "Friday":
        return "Sexta-feira";
      case "Saturday":
        return "Sábado";
    }
  }

  function traduz_mes($nome_mes_en){
    switch($nome_mes_en){
      case "January":
        return "janeiro";
      case "February":
        return "fevereiro";
      case "March":
        return "março";
      case "April":
        return "abril";
      case "May":
        return "maio";
      case "June":
        return "junho";
      case "July":
        return "julho";
      case "August":
        return "agosto";
      case "September":
        return "setembro";
      case "October":
        return "outubro";
      case "November":
        return "novembro";
      case "December":
        return "dezembro";
    }
  }

  function nome_mes($nome_mes_en){
    switch($nome_mes_en){
      case "1":
        return "janeiro";
      case "2":
        return "fevereiro";
      case "3":
        return "março";
      case "4":
        return "abril";
      case "5":
        return "maio";
      case "6":
        return "junho";
      case "7":
        return "julho";
      case "8":
        return "agosto";
      case "9":
        return "setembro";
      case "10":
        return "outubro";
      case "11":
        return "novembro";
      case "12":
        return "dezembro";
    }
  }


  function hora4d($h_8){
    return substr($h_8,0,5);
  }


  function checka($n_ch){
    if ($n_ch==1){
      return " checked";
    } else {
      return "";
    }
  }

  function simnao($n_ch){
    if ($n_ch==1){
      return "sim";
    } else {
      return "não";
    }
  }

  function get_status($n_ch){
    if ($n_ch==1){
      return "habilitado";
    } else {
      return "desabilitado";
    }
  }

  function dia_semana($nome_dia_en){
    switch($nome_dia_en){
      case "0":
        return "Domingo";
      case "1":
        return "Segunda-feira";
      case "2":
        return "Terca-feira";
      case "3":
        return "Quarta-feira";
      case "4":
        return "Quinta-feira";
      case "5":
        return "Sexta-feira";
      case "6":
        return "Sabado";
    }
  }

  function mostra_dia_semana($data_semana){
    $dt_s = dthifen2dtbarra($data_semana);
    $dt_c1 = substr($dt_s,0,2);
    $dt_c2 = substr($dt_s,3,2);
    $dt_c3 = substr($dt_s,6,4);
    $dt_s = mktime(0,0,0,$dt_c2,$dt_c1,$dt_c3);
    return dia_semana(strftime("%w",$dt_s));
  }

  function valor2dec($v2c){
    return number_format($v2c, 2, ".", "");
  }

  function pon2vir($t_v){
    $t_v = str_replace("."," ",$t_v); //str_replace(".",",",$t_v);
    $pon2vir_tam = strlen($t_v);
    $pon2vir_pr = substr($t_v, 0, $pon2vir_tam - 2);
    $pon2vir_se = substr($t_v, $pon2vir_tam - 2, $pon2vir_tam);
    return str_replace(" ","","$pon2vir_pr , $pon2vir_se");
    //return str_replace(".",",",$t_v);
  }

  function sub_data($dia_subs,$data_sub){
    if (ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $data_sub, $sep)) {
      $dia_sub = $sep[1];
      $mes_sub = $sep[2];
      $ano_sub = $sep[3];
    }
    if($mes_sub == "01" || $mes_sub == "02" || $mes_sub == "04" || $mes_sub == "06" || $mes_sub == "08" || $mes_sub == "09" || $mes_sub == "11"){
      for ($cont_sub = $dia_subs ; $cont_sub > 0 ; $cont_sub--){
      $dia_sub--;
        if($dia_sub == 00){
          $dia_sub = 31;
          $mes_sub = $mes_sub -1;
          if($mes_sub == 00){
            $mes_sub = 12;
            $ano_sub = $ano_sub - 1;
          }
        }
      }
    }
    if($mes_sub == "05" || $mes_sub == "07" || $mes_sub == "10" || $mes_sub == "12" ){
      for ($cont_sub = $dia_subs ; $cont_sub > 0 ; $cont_sub--){
      $dia_sub--;
        if($dia_sub == 00){
          $dia_sub = 30;
          $mes_sub = $mes_sub -1;
        }
      }
    }
    if($ano_sub % 4 == 0 && $ano_sub%100 != 0){
      if($mes_sub == "03" ){
        for ($cont_sub = $dia_subs ; $cont_sub > 0 ; $cont_sub--){
          $dia_sub--;
          if($dia_sub == 00){
            $dia_sub = 29;
            $mes_sub = $mes_sub -1;
          }
        }
      }
    } else {
      if($mes_sub == "03" ){
        for ($cont_sub = $dia_subs ; $cont_sub > 0 ; $cont_sub--){
          $dia_sub--;
          if($dia_sub == 00){
            $dia_sub = 28;
            $mes_sub = $mes_sub -1;
          }
        }
      }
    }
    if(strlen($dia_sub) == 1){$dia_sub = "0".$dia_sub;}
    if(strlen($mes_sub) == 1){$mes_sub = "0".$mes_sub;}
    $nova_dt_sub = $dia_sub."/".$mes_sub."/".$ano_sub ;
    return $nova_dt_sub;
  }

  function add_data($dia_adds,$data_add){
    if (ereg ("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $data_add, $sep)) {
      $dia_add = $sep[1];
      $mes_add = $sep[2];
      $ano_add = $sep[3];
    }
    $i = $dia_adds;
    for($i = 0;$i<$dia_adds;$i++){
      if ($mes_add == 01 || $mes_add == 03 || $mes_add == 05 || $mes_add == 07 || $mes_add == 8 || $mes_add == 10 || $mes_add == 12){
        if($mes_add == 12 && $dia_add == 31){
          $mes_add = 01;
          $ano_add++;
          $dia_add = 00;
        }
        if($dia_add == 31 && $mes_add != 12){
          $mes_add++;
          $dia_add = 00;
        }
      }
      if($mes_add == 04 || $mes_add == 06 || $mes_add == 09 || $mes_add == 11){
        if($dia_add == 30){
          $dia_add =  00;
          $mes_add++;
        }
      }
      if($mes_add == 02){
        if($ano_add % 4 == 0 && $ano_add % 100 != 0){
          if($dia_add == 29){
            $dia_add = 00;
            $mes_add++;
          }
        } else {
          if($dia_add == 28){
            $dia_add = 00;
            $mes_add++;
          }
        }
      }
      $dia_add++;
    }
    if(strlen($dia_add) == 1){$dia_add = "0".$dia_add;};
    if(strlen($mes_add) == 1){$mes_add = "0".$mes_add;};
    $nova_dt_add = $dia_add."/".$mes_add."/".$ano_add;
    return $nova_dt_add;
  }

  function dthifen2nome_mes($dt_fnc){
    if ($dt_fnc<>""){
      $dt_c = explode("-",$dt_fnc);
      $cal_data = getdate(mktime(1,1,1,$dt_c[1],$dt_c[2],$dt_c[0]));
      return dia_semana($cal_data[wday]);
    }
  }

  function pega1nome($str_fnc){
    $strs_fnc = explode(" ",$str_fnc);
    $nome2 = "$strs_fnc[0]";
    return $nome2;
  }

function txt2lnk($str_data){
  //$str_data = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\" target=\"_BLANK\">\\0</a>", $str_data);
  //return $str_data;
////  $str_data = eregi_replace ("[[:alpha:]]+://www", "www",$str_data);
////  $str_data = eregi_replace ("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/](\.[a-z0-9-]{2,5})+", "<a href=\\0 target=_blank>\\0</a>", $str_data);
////  $str_data = eregi_replace ("www.[^<>[:space:]]+[[:alnum:]/](\.[a-z0-9-]{2,5})+", "<a href=http://\\0 target=_blank>\\0</a>", $str_data);
  //  $str_data = ereg_replace ("[[:alpha:]]+@[^<>[:space:]]+[[:alnum:]/](\.[a-z0-9-]{2,4})+", "<a href=mailto:\\0 target=_blank>\\0</a>", $str_data);
////  $str_data = eregi_replace('[_a-zA-z0-9\-]+(\.[_a-zA-z0-9\-]+)*\@' . '[_a-zA-z0-9\-]+(\.[a-zA-z]{1,3})+', '<a href="mailto:\\0">\\0</a>', $str_data);
  return $str_data;
}

//////////////////////////////////////////
// VETOR DE SEXO
//////////////////////////////////////////
$lst_sexo[0] = "masculino";
$lst_sexo[1] = "feminino";


//////////////////////////////////////////
// VETOR DE VEICULO TIPO
//////////////////////////////////////////
$lst_veiculotp[0] = "vazio";
$lst_veiculotp[1] = "parcial";
//$lst_veiculotp[2] = "carregado";

//////////////////////////////////////////
// VETOR DE ESTADO CIVIL
//////////////////////////////////////////
$lst_estado_civil[0] = "Casado";
$lst_estado_civil[1] = "Divorciado";
$lst_estado_civil[2] = "Solteiro";
$lst_estado_civil[3] = "Viúvo";
$lst_estado_civil[4] = "Outros";

//////////////////////////////////////////
// VETOR DE DEFICIENTES
//////////////////////////////////////////
$lst_deficiente[0] = "Não";
$lst_deficiente[1] = "Auditivo";
$lst_deficiente[2] = "Físico";
$lst_deficiente[3] = "Visual";

//////////////////////////////////////////
// VETOR DE CORES
//////////////////////////////////////////
$lst_cor[1][0] = "amarelo";
$lst_cor[1][1] = "yellow";
$lst_cor[1][2] = "F1F203";
$lst_cor[2][0] = "azul";
$lst_cor[2][1] = "blue";
$lst_cor[2][2] = "0000FF";
$lst_cor[3][0] = "laranja";
$lst_cor[3][1] = "orange";
$lst_cor[3][2] = "FF9922";
$lst_cor[4][0] = "vermelho";
$lst_cor[4][1] = "red";
$lst_cor[4][2] = "FF0000";

//////////////////////////////////////////
// VETOR DE UNIDADES
//////////////////////////////////////////
$lst_unidade[1] = "g";
$lst_unidade["g"] = "1";
$lst_unidade_fm[1] = "2";
$lst_unidade_fm["g"] = "2";

$lst_unidade[2] = "kg";
$lst_unidade["kg"] = "2";
$lst_unidade_fm[2] = 2;
$lst_unidade_fm["kg"] = 2;

$lst_unidade[3] = "lb";
$lst_unidade["lb"] = "3";
$lst_unidade_fm[3] = "3";
$lst_unidade_fm["lb"] = "3";

$lst_unidade[4] = "pal";
$lst_unidade["pal"] = "4";
$lst_unidade_fm[4] = "0";
$lst_unidade_fm["pal"] = "0";

$lst_unidade[5] = "un";
$lst_unidade["un"] = "5";
$lst_unidade_fm[5] = "0";
$lst_unidade_fm["un"] = "0";
$lst_unidade["uni"] = "5";
$lst_unidade_fm["uni"] = "0";

$lst_unidade[6] = "cx";
$lst_unidade["cx"] = "6";
$lst_unidade_fm[6] = "0";
$lst_unidade_fm["cx"] = "0";

$lst_unidade[7] = "m";
$lst_unidade["m"] = "7";
$lst_unidade_fm[7] = "2";
$lst_unidade_fm["m"] = "2";

$lst_unidade[8] = "m3";
$lst_unidade["m3"] = "8";
$lst_unidade_fm[8] = "2";
$lst_unidade_fm["m3"] = "2";

$lst_unidade[9] = "pc";
$lst_unidade["pc"] = "9";
$lst_unidade_fm[9] = "0";
$lst_unidade_fm["pc"] = "2";

$lst_unidade[10] = "ml";
$lst_unidade["ml"] = "10";
$lst_unidade_fm[10] = "2";
$lst_unidade_fm["ml"] = "2";

$lst_unidade[11] = "l";
$lst_unidade["l"] = "11";
$lst_unidade_fm[11] = "2";
$lst_unidade_fm["l"] = "2";

//////////////////////////////////////////
// VETOR DE STATUS
//////////////////////////////////////////
$lst_status[5] = "a liberar";
$lst_status[10] = "a processar";
$lst_status[15] = "em preparação RF";
$lst_status[20] = "em preparação manual";
$lst_status[30] = "validado";
$lst_status[45] = "enviado";
$lst_status[50] = "entregue";
$lst_status[70] = "em ruptura";
//$lst_status[80] = "em inspeção";
$lst_status[90] = "faltante";
$lst_status[-1] = "cancelado";
$lst_status[100] = "recusa";


//////////////////////////////////////////
// VETOR DE STATUS DA AGENDA
//////////////////////////////////////////
$lst_status_age[-2] = "não compareceu";
$lst_status_age[-1] = "cancelado";
$lst_status_age[0] = "agendado";
$lst_status_age[1] = "em processo";
$lst_status_age[2] = "coletado";


//////////////////////////////////////////
// VETOR DE STATUS DEVOLUCAO
//////////////////////////////////////////
$lst_status_dev[5] = "a devolver";
$lst_status_dev[10] = "confirmado";


//////////////////////////////////////////
// VETOR DE TIPO DE EMPRESA
//////////////////////////////////////////
$lst_tipo_empresa[1] = "Cliente/Fornecedor";
$lst_tipo_empresa[2] = "Site/Terceiro";
$lst_tipo_empresa[3] = "Transportadora";


//////////////////////////////////////////
// VETOR DE TIPO CARTAO
//////////////////////////////////////////
$lst_tipo_cartao[0][0] = "cartão";
$lst_tipo_cartao[0][1] = "0";
$lst_tipo_cartao[1][0] = "kit";
$lst_tipo_cartao[1][1] = "-1";
$lst_tipo_cartao[2][0] = "receita";
$lst_tipo_cartao[2][1] = "-2";

//////////////////////////////////////////
// VETOR DE ESTADOS BRASILEIROS
//////////////////////////////////////////
//$lst_estado[0] = "Exterior";
$lst_estado[1] = "AL";
$lst_estado[2] = "AM";
$lst_estado[3] = "AP";
$lst_estado[4] = "BA";
$lst_estado[5] = "CE";
$lst_estado[6] = "DF";
$lst_estado[7] = "ES";
$lst_estado[8] = "GO";
$lst_estado[9] = "MA";
$lst_estado[10] = "MT";
$lst_estado[11] = "MS";
$lst_estado[12] = "MG";
$lst_estado[13] = "PA";
$lst_estado[14] = "PB";
$lst_estado[15] = "PR";
$lst_estado[16] = "PE";
$lst_estado[17] = "PI";
$lst_estado[18] = "RJ";
$lst_estado[19] = "RN";
$lst_estado[20] = "RO";
$lst_estado[21] = "RS";
$lst_estado[22] = "RR";
$lst_estado[23] = "SC";
$lst_estado[24] = "SE";
$lst_estado[25] = "SP";
$lst_estado[26] = "TO";

//////////////////////////////////////////
// VETOR DE ESTADOS BRASILEIROS
//////////////////////////////////////////
$lst_estadod["AL"] = "AL";
$lst_estadod["AM"] = "AM";
$lst_estadod["AP"] = "AP";
$lst_estadod["BA"] = "BA";
$lst_estadod["CE"] = "CE";
$lst_estadod["DF"] = "DF";
$lst_estadod["ES"] = "ES";
$lst_estadod["GO"] = "GO";
$lst_estadod["MA"] = "MA";
$lst_estadod["MT"] = "MT";
$lst_estadod["MS"] = "MS";
$lst_estadod["MG"] = "MG";
$lst_estadod["PA"] = "PA";
$lst_estadod["PB"] = "PB";
$lst_estadod["PR"] = "PR";
$lst_estadod["PE"] = "PE";
$lst_estadod["PI"] = "PI";
$lst_estadod["RJ"] = "RJ";
$lst_estadod["RN"] = "RN";
$lst_estadod["RO"] = "RO";
$lst_estadod["RS"] = "RS";
$lst_estadod["RR"] = "RR";
$lst_estadod["SC"] = "SC";
$lst_estadod["SE"] = "SE";
$lst_estadod["SP"] = "SP";
$lst_estadod["TO"] = "TO";

//////////////////////////////////////////
// VETOR DE ESCOLARIDADE
//////////////////////////////////////////
$lst_escolaridade[0] = "Ensino Fundamental (1º Grau) Incompleto";
$lst_escolaridade[1] = "Ensino Fundamental (1º Grau) Completo";
$lst_escolaridade[2] = "Ensino Médio (2º Grau) Incompleto";
$lst_escolaridade[3] = "Ensino Médio (2º Grau) Completo";
$lst_escolaridade[4] = "Superior Incompleto";
$lst_escolaridade[5] = "Superior Completo";
$lst_escolaridade[6] = "Pós-Graduado";
$lst_escolaridade[7] = "Mestrado";
$lst_escolaridade[8] = "Doutorado";
$lst_escolaridade[9] = "Pós-Doutorado";

//////////////////////////////////////////
// VETOR DE NOTA - 0 A 10
//////////////////////////////////////////
$lst_nota0a10[0] = "0";
$lst_nota0a10[1] = "1";
$lst_nota0a10[2] = "2";
$lst_nota0a10[3] = "3";
$lst_nota0a10[4] = "4";
$lst_nota0a10[5] = "5";
$lst_nota0a10[6] = "6";
$lst_nota0a10[7] = "7";
$lst_nota0a10[8] = "8";
$lst_nota0a10[9] = "9";
$lst_nota0a10[10] = "10";


//////////////////////////////////////////
// VETOR DE TIPOS DE CAMPOS
//////////////////////////////////////////
$lst_campo[1] = "TextBox";
$lst_campo[2] = "RadioBox";
$lst_campo[3] = "CheckBox";

//////////////////////////////////////////
// VETOR DE TIPOS DE CHECKLISTS
//////////////////////////////////////////
$lst_chk_tipo[1] = "Portaria Entrada";
$lst_chk_tipo[2] = "Portaria Saída";
$lst_chk_tipo[3] = "Doca";

//////////////////////////////////////////
// VETOR DE MASCARA DE CAMPOS
//////////////////////////////////////////
$lst_mascara[1]["de"] = "CEP";
$lst_mascara[1]["fm"] = "99999-999";
$lst_mascara[1]["js"] = "mask";
$lst_mascara[1]["tp"] = "varchar";
$lst_mascara[2]["de"] = "CNPJ";
$lst_mascara[2]["fm"] = "999.999.999/999-99";
$lst_mascara[2]["js"] = "mask";
$lst_mascara[2]["tp"] = "varchar";
$lst_mascara[3]["de"] = "CPF";
$lst_mascara[3]["fm"] = "999.999.999-99";
$lst_mascara[3]["js"] = "mask";
$lst_mascara[3]["tp"] = "varchar";
$lst_mascara[4]["de"] = "Data";
$lst_mascara[4]["fm"] = "99/99/9999";
$lst_mascara[4]["js"] = "mask";
$lst_mascara[4]["tp"] = "varchar";
$lst_mascara[5]["de"] = "Hora";
$lst_mascara[5]["fm"] = "99:99";
$lst_mascara[5]["js"] = "mask";
$lst_mascara[5]["tp"] = "varchar";
$lst_mascara[6]["de"] = "Placa de Veículo";
$lst_mascara[6]["fm"] = "aaa-9999";
$lst_mascara[6]["js"] = "mask";
$lst_mascara[6]["tp"] = "varchar";
$lst_mascara[7]["de"] = "Telefone";
$lst_mascara[7]["fm"] = "(99) 9999-9999";
$lst_mascara[7]["js"] = "mask";
$lst_mascara[7]["tp"] = "varchar";
$lst_mascara[8]["de"] = "Somente Número";
$lst_mascara[8]["fm"] = "999999";
$lst_mascara[8]["js"] = "numeric";
$lst_mascara[8]["tp"] = "integer";
$lst_mascara[9]["de"] = "Decimal";
$lst_mascara[9]["fm"] = "99999.99";
$lst_mascara[9]["js"] = "priceFormat";
$lst_mascara[9]["tp"] = "decimal";


//////////////////////////////////////////
// VETOR DE TIPOS DE MOVIMENTOS
//////////////////////////////////////////
$lst_status_mov[1] = "em andamento";
$lst_status_mov[2] = "finalizado";


//////////////////////////////////////////
// VETOR DE TIPOS DE ENTRADA
//////////////////////////////////////////
$lst_tipo_entrada[1] = "visitante";
$lst_tipo_entrada[2] = "funcionário";
$lst_tipo_entrada[3] = "motorista";


//////////////////////////////////////////
// VETOR DE TIPOS DE ENTRADA
//////////////////////////////////////////
$lst_ctiv_status[-1] = "cancelado";
$lst_ctiv_status[0] = "espera pátio";
$lst_ctiv_status[1] = "doca";
$lst_ctiv_status[2] = "saída";
$lst_ctiv_status[3] = "concluído";


//////////////////////////////////////////
// VETOR DE KPI´S
//////////////////////////////////////////
$gr_kpi[0] = "kpiTempoPermanencia"; $gr_kpi_nome[0] = "Tempo de Permanencia";
$gr_kpi[1] = "kpiTempoCargaDescarga"; $gr_kpi_nome[1] = "Tempo de Carga e Descarga";
$gr_kpi[2] = "kpiTempoEsperaCarregamento"; $gr_kpi_nome[2] = "Tempo de Espera Carregamento";
$gr_kpi[3] = "kpiTempoEsperaSairCD"; $gr_kpi_nome[3] = "Tempo de Espera para Sair do CD";
$gr_kpi[4] = "kpiTempoEsperaPatio"; $gr_kpi_nome[4] = "Tempo de Espera Patio Interno";
$gr_kpi[5] = "kpiQtdInOutVisitantes"; $gr_kpi_nome[5] = "Qtd. Entrada e Saida Visitantes";
$gr_kpi[6] = "kpiQtdInOutFunTer"; $gr_kpi_nome[6] = "Qtd. Entrada e Saida Funcionarios e Terceiros";

function ebcdic2word($txt){
	$ebc["0"] = NULL;
	$ebc["40"] = " ";
	$ebc["4A"] = "?";
	$ebc["4B"] = ".";
	$ebc["4C"] = "<";
	$ebc["4D"] = "(";
	$ebc["4E"] = "+";
	$ebc["50"] = "&";
	$ebc["5A"] = "!";
	$ebc["5B"] = "\$";
	$ebc["5C"] = "*";
	$ebc["5D"] = ")";
	$ebc["5E"] = ";";
	$ebc["5F"] = "¬";
	$ebc["60"] = "-";
	$ebc["61"] = "/";
	$ebc["6A"] = "|";
	$ebc["6B"] = ",";
	$ebc["6C"] = "%";
	$ebc["6D"] = "_";
	$ebc["6E"] = ">";
	$ebc["6F"] = "?";
	$ebc["7A"] = ":";
	$ebc["7B"] = "#";
	$ebc["7C"] = "@";
	$ebc["7D"] = "'";
	$ebc["7E"] = "=";
	$ebc["7F"] = "\"";
	$ebc["81"] = "a";
	$ebc["82"] = "b";
	$ebc["83"] = "c";
	$ebc["84"] = "d";
	$ebc["85"] = "e";
	$ebc["86"] = "f";
	$ebc["87"] = "g";
	$ebc["88"] = "h";
	$ebc["89"] = "i";
	$ebc["91"] = "j";
	$ebc["92"] = "k";
	$ebc["93"] = "l";
	$ebc["94"] = "m";
	$ebc["95"] = "n";
	$ebc["96"] = "o";
	$ebc["97"] = "p";
	$ebc["98"] = "q";
	$ebc["99"] = "r";
	$ebc["A1"] = "~ ";
	$ebc["A2"] = "s";
	$ebc["A3"] = "t";
	$ebc["A4"] = "u";
	$ebc["A5"] = "v";
	$ebc["A6"] = "w";
	$ebc["A7"] = "x";
	$ebc["A8"] = "y";
	$ebc["A9"] = "z";
	$ebc["B9"] = "`";
	$ebc["C0"] = "{ ";
	$ebc["C1"] = "A";
	$ebc["C2"] = "B";
	$ebc["C3"] = "C";
	$ebc["C4"] = "D";
	$ebc["C5"] = "E";
	$ebc["C6"] = "F";
	$ebc["C7"] = "G";
	$ebc["C8"] = "H";
	$ebc["C9"] = "I";
	$ebc["D0"] = "} ";
	$ebc["D1"] = "J";
	$ebc["D2"] = "K";
	$ebc["D3"] = "L";
	$ebc["D4"] = "M";
	$ebc["D5"] = "N";
	$ebc["D6"] = "O";
	$ebc["D7"] = "P";
	$ebc["D8"] = "Q";
	$ebc["D9"] = "R";
	$ebc["E0"] = "\\";
	$ebc["E2"] = "S";
	$ebc["E3"] = "T";
	$ebc["E4"] = "U";
	$ebc["E5"] = "V";
	$ebc["E6"] = "W";
	$ebc["E7"] = "X";
	$ebc["E8"] = "Y";
	$ebc["E9"] = "Z";
	$ebc["F0"] = "0";
	$ebc["F1"] = "1";
	$ebc["F2"] = "2";
	$ebc["F3"] = "3";
	$ebc["F4"] = "4";
	$ebc["F5"] = "5";
	$ebc["F6"] = "6";
	$ebc["F7"] = "7";
	$ebc["F8"] = "8";
	$ebc["F9"] = "9";
	$cont = strlen($txt);
	$conti = 0;
	$novotxt = NULL;
	for($i=0;$i<=$cont;$i=$i+2){
		$hx = substr($txt,$i,2);
		$novotxt .= $ebc[$hx];
	}
	return $novotxt;
}


?>
