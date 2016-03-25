<?
/*#######################################################################
#............INFORMACAO.SOBRE.O.DESENVOLVIMENTO.E.A.CRIACAO.............#
#########################################################################
#.............................. Analista:....Juliano Muniz..............#
#.................................E-mail:....juliano.muniz@uol.com.br...#
#................................Celular:....(11) 8611-8004.............#
#.......................................................................#
#.."BEM-AVENTURADO aquele que teme ao Senhor e anda nos seus caminhos...#
#..Pois comeras do trabalho das tuas maos; feliz seras, e te ira bem."..#
#...........................................* Salmo 128:1-2.............#
#######################################################################*/

class funcoes{

	/*=====================================================================
	   METODO COMPLETAR STRINGS COM " " ou "0"
	=====================================================================*/

	public function fillStr($str,$tipo,$qtd){
		$str = $this->tiraAcento($str);
		$strRetorno = "";
		if (strlen($str)<$qtd){
			$strRetorno = $str;
			for ($i=strlen($str); $i < $qtd; $i++) {
				if ($tipo=="int"){
					$strRetorno = "0".$strRetorno;
				} else if ($tipo=="str"){
					$strRetorno = $strRetorno." ";
				}
			}
		} else if (strlen($str)>$qtd){
			if($tipo=="int"){
				$dif = strlen($str)-$qtd;
				$strRetorno = substr($str,$dif,$qtd);
			}else{
				$strRetorno = substr($str,0,$qtd);
			}
		} else {
			$strRetorno = $str;
		}
		return $strRetorno;
	}
	

	/*=====================================================================
	   METODO PARA TIRAR ACENTUACAO
	=====================================================================*/
	
	public function tiraAcento($texto){
		return $texto;
		//if(mb_check_encoding($texto, 'UTF-8')){
			$texto = utf8_decode($texto);
		//}
		$a = array("/[ÂÀÁÄÃ]/"=>"A","/[âãàáä]/"=>"a","/[ÊÈÉË]/"=>"E","/[êèéë]/"=>"e","/[ÎÍÌÏ]/"=>"I","/[îíìï]/"=>"i","/[ÔÕÒÓÖ]/"=>"O","/[ôõòóö]/"=>"o","/[ÛÙÚÜ]/"=>"U","/[ûúùü]/"=>"u","/ç/"=>"c","/Ç/"=> "C");
		return preg_replace(array_keys($a), array_values($a), $texto);
	}
	

	/*=====================================================================
	   METODO PARA GERAR UM NOME DE ARQUIVO COM DATA JULIANA
	=====================================================================*/

	public function giveName(){
		$diaAno = intval(date("z"))+1; // 0 a 364 / 365 bisexto no PHP (+1 para outros sistemas)
		$hora = date("His");
		$arq = $diaAno.$hora;
		$arq = $this->fillStr($arq, "int", 9);
		return $arq;
	}
	
	
	/*=====================================================================
	   METODO PARA TIRAR A FORMATACAO
	=====================================================================*/

	public function cleanStr($str){
		$nstr = str_replace("\\","",$str);
		$nstr = str_replace("\/","",$nstr);
		$nstr = str_replace("/","",$nstr);
		$nstr = str_replace(".","",$nstr);
		$nstr = str_replace(",","",$nstr);
		$nstr = str_replace("-","",$nstr);
		$nstr = str_replace("(","",$nstr);
		$nstr = str_replace("}","",$nstr);
		$nstr = str_replace("{","",$nstr);
		$nstr = str_replace("}","",$nstr);
		$nstr = str_replace(":","",$nstr);
		$nstr = str_replace(";","",$nstr);
		return $nstr;
	}
	
	
	/*=====================================================================
	   METODOS PARA TRATAMENTO DE DATAS
	=====================================================================*/
	
	public function dtbarra2dthifen($dt_fnc){
		if ($dt_fnc<>""){
			$datacerta1 = substr($dt_fnc,0,2);
			$datacerta2 = substr($dt_fnc,3,2);
			$datacerta3 = substr($dt_fnc,6,4);
			return "$datacerta3-$datacerta2-$datacerta1";
		}
	}
	public function dthifen2dtbarra($dt_fnc){
		if ($dt_fnc<>""){
		  $datacerta1 = substr($dt_fnc,8,2);
		  $datacerta2 = substr($dt_fnc,5,2);
		  $datacerta3 = substr($dt_fnc,0,4);
		  return "$datacerta1/$datacerta2/$datacerta3";
		}
	}
	public function dtbarra2dtas400($dt_fnc){
		if ($dt_fnc<>""){
			$datacerta1 = substr($dt_fnc,0,2);
			$datacerta2 = substr($dt_fnc,3,2);
			$datacerta3 = substr($dt_fnc,6,4);
			return "$datacerta3$datacerta2$datacerta1";
		}
	}
	public function dtNfe2dtas400($dt_fnc){
		if ($dt_fnc<>""){
			$dt_fnc = explode("-", $dt_fnc);
			$datacerta1 = $dt_fnc[0];
			if(strlen($dt_fnc[1]) == 3){
				$datacerta2 = $this->sigla_mes(strtolower($dt_fnc[1]));
			}else{
				$datacerta2 = $dt_fnc[1];
			}
			$datacerta3 = $dt_fnc[2];
			return "$datacerta3$datacerta2$datacerta1";
		}
	}	
	public function dthifen2dtas400($dt_fnc){
		if ($dt_fnc<>""){
			$datacerta1 = substr($dt_fnc,8,2);
			$datacerta2 = substr($dt_fnc,5,2);
			$datacerta3 = substr($dt_fnc,0,4);
			//return "$datacerta1/$datacerta2/$datacerta3";
			return $datacerta3.$datacerta2.$datacerta1;
		}
	}
	public function dtponto2dtas400($dt_fnc){
		return $this->dtbarra2dtas400($dt_fnc);
	}
	public function dtas4002dtbarra($dt_fnc){
		if ($dt_fnc<>""){
			$datacerta1 = substr($dt_fnc,6,2);
			$datacerta2 = substr($dt_fnc,4,2);
			$datacerta3 = substr($dt_fnc,0,4);
			return "$datacerta1/$datacerta2/$datacerta3";
		}
	}
	public function dtas4002dthifen($dt_fnc){
		if ($dt_fnc<>""){
			$datacerta1 = substr($dt_fnc,6,2);
			$datacerta2 = substr($dt_fnc,4,2);
			$datacerta3 = substr($dt_fnc,0,4);
			return "$datacerta3-$datacerta2-$datacerta1";
		}
	}	
	public function dtas4002dtponto($dt_fnc){
		return str_replace("/", ".", $this->dtas4002dtbarra($dt_fnc) );
	}
	public function horaas400($h){
		$inv = strrev($h);
		$nh = substr($inv,0,2).":".substr($inv,2,2).":".substr($inv,4,2);
		$nh = strrev($nh);
		return $nh;
	}
  	public function sigla_mes($sigla){
		switch($sigla){
		case "jan":
			return "01";
		case "fev":
			return "02";
		case "mar":
			return "03";
		case "abr":
			return "04";
		case "mai":
			return "05";
		case "jun":
			return "06";
		case "jul":
			return "07";
		case "ago":
			return "08";
		case "set":
			return "09";
		case "out":
			return "10";
		case "nov":
			return "11";
		case "dez":
			return "12";
		}	
	}
	public function getFormatoNumero($numeroFnc,$tipoFnc){
		$tipoFnc = trim($tipoFnc);
		$num = doubleval($numeroFnc);
		if($tipoFnc=="kg"){ $num = number_format($num,2,".","");}
		if($tipoFnc=="g"){ $num = number_format($num,2,".","");}
		if($tipoFnc=="as400"){ $num = number_format($num,3,"","");}
		if($tipoFnc=="pal"){ $num = number_format($num,0,".","");}
		if($tipoFnc=="un"){ $num = number_format($num,0,".","");}
		if($tipoFnc=="cx"){ $num = number_format($num,0,".","");}
		if($tipoFnc=="m2"){ $num = number_format($num,2,".","");}
		if($tipoFnc=="m3"){ $num = number_format($num,2,".","");}
		if($tipoFnc=="pc"){ $num = number_format($num,0,".","");}
		if($tipoFnc=="ml"){ $num = number_format($num,2,".","");}
		if($tipoFnc=="l"){ $num = number_format($num,2,".","");}
		return $num;
	}


	

}

?>