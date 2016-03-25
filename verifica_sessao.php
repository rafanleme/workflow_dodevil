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

  $marcador_inicial = microtime(1);

  ini_set("session.gc_maxlifetime",604800);   // 7 dias
  ini_set("session.cache_expire",604800);     // 7 dias
  include($sys_conteudo_sp_url."include/header.php");
  if(!(session_is_registered("ses_login") AND session_is_registered("ses_nome") AND session_is_registered("ses_senha") AND session_is_registered("ses_ok"))){
     echo "<font face=Verdana size=2><b>SISTEMA PONDERAL/b> - <font color=red>Voc&ecirc; precisa estar logado para ter acesso!</font></font>";
     echo "<script language=\"JavaScript\">";
     echo "var page = \"".$sys_conteudo_sp_url."login.php?mensagem=Voc&ecirc; n&atilde;o est&aacute; logado!\";";
     echo "var page2 = \"".$sys_conteudo_sp_url."index.php?erro=2\";";
     echo "win = window.parent.Wnd_Sys_conteudo_principal;";
     echo "if (!(win)){";
     echo "  window.top.location.href = page2;";
     echo "} else {";
     echo "  window.parent.Wnd_Sys_conteudo_principal.location.href = page";
     echo "}";
     echo "</script>";
     exit;
  } else {
     if ((!empty($sys_conteudo_sp_url)) AND ($sys_conteudo_sp_url<>"")){
        include($sys_conteudo_sp_url."verifica_permissao.php");
     }
  }
?>