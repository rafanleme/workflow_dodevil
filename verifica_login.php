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

include ("include/header.php");

    $inst = "SELECT * FROM sys_usuario WHERE su_status=1 AND su_login='".$_POST["login"]."' AND su_senha=md5('".$_POST["senha"]."');";
    $resu = mysql_query($inst);
    $cont = mysql_num_rows($resu);
    if ($cont>0){
      $row = mysql_fetch_array($resu);
      $_SESSION["ses_login"] = $row["su_login"];
      $_SESSION["ses_id"] = $row["su_id"];
      $_SESSION["ses_nome"] = $row["su_nome"];
      $_SESSION["ses_tipo"] = $row["su_tipo"];
      $_SESSION["ses_senha"] = $row["su_senha"];
      $_SESSION["ses_ok"] = "true";
      //session_register("ses_login","ses_senha","ses_nome","ses_ok","ses_suid");
      echo "<html>";
      echo "<head>";
      echo "<title>:: SISTEMA PONDERAL ELETRONICO ::</title>";
      echo "</head>";
      if($_POST["rf"]=="0"){
		  echo "<frameset rows=\"100,*,20\" border=0 frameborder=0>";
	      echo "  <frame name=\"Wnd_CONTEUDOSYS_Wnd_SYStopo\" src=\"topo.php\" border=0 frameborder=0 scrolling=no resizable=no>";
	      echo "  <frame name=\"Wnd_CONTEUDOSYS_Wnd_SYSbaixo\" src=\"adm_home.php\" border=0 frameborder=0 scrolling=yes resizable=no onLoad=\"HM_UseFrameLoad=1;if(window.HM_f_LoadMenus)HM_f_LoadMenus();\">";
	      echo "  <frame name=\"Wnd_CONTEUDOSYS_Wnd_SYSrodape\" src=\"rodape.php\" border=0 frameborder=0 scrolling=no resizable=no>";
      } else if($_POST["rf"]=="1"){
          echo "<frameset rows=\"40,*,20\" border=0 frameborder=0>";	      echo "  <frame name=\"Wnd_CONTEUDOSYS_Wnd_SYStopo\" src=\"topo_rf.php\" border=0 frameborder=0 scrolling=no resizable=no>";
	      echo "  <frame name=\"Wnd_CONTEUDOSYS_Wnd_SYSbaixo\" src=\"adm_home_rf.php\" border=0 frameborder=0 scrolling=yes resizable=no onLoad=\"HM_UseFrameLoad=1;if(window.HM_f_LoadMenus)HM_f_LoadMenus();\">";
	      echo "  <frame name=\"Wnd_CONTEUDOSYS_Wnd_SYSrodape\" src=\"rodape_rf.php\" border=0 frameborder=0 scrolling=no resizable=no>";
      }
      echo "</frameset>";
      echo "</html>";
      exit;
    } else {
      echo "<script language=\"JavaScript\">";
      if($_POST["rf"]=="0"){
		  echo "   var page = \"login.php?mensagem=Usuário não tem acesso!\";";
      } else if($_POST["rf"]=="1"){		  echo "   var page = \"login_rf.php?mensagem=Usuário não tem acesso!\";";
      }
      echo "   location.href=page;";
      echo "</script>";
      exit;
    }

?>
