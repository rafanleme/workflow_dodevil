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

  $sys_conteudo_sp_url = "../../";
  include($sys_conteudo_sp_url."verifica_sessao.php");
  if ($tipo_perm=="R"){
     $mensagem="Você não têm permissão para alterar o cadastro.";
     echo "<script language=\"JavaScript\">";
     echo "   var page = \"index.php?mensagem=".$mensagem."\";";
     echo "   location.href=page;";
     echo "</script>";
     exit;
  }
  
  $mensagem="";
  $apoio="";
  $apoio2=";";
  $sql="";

  if ($acao=="i"){
     $apoio = "INSERT INTO sys_usuario SET ";
     $sql = $apoio." su_login='".$su_prontuario."', su_nome='".$su_nome."', su_status=".$su_status.$apoio2;
     $mensagem = "Cadastro inserido com sucesso!";
  } else if ($acao=="e"){
     $apoio = "UPDATE sys_usuario SET ";
     $apoio2 = " WHERE su_id=".$su_id.";";
     $sql = $apoio." su_login='".$su_prontuario."', su_nome='".$su_nome."', su_status=".$su_status.$apoio2;
     $mensagem = "Cadastro alterado com sucesso!";
  } else if ($acao=="d"){
     $apoio = "DELETE FROM sys_usuario ";
     $apoio2 = " WHERE su_id=".$su_id.";";
     $sql = $apoio.$apoio2;
	 $mensagem = "Cadastro excluído com sucesso!";
  }

  if (!mysql_query($sql)){
     $mensagem="Ocorreu um erro, contate o administrador.";
  }

  echo "<script language=\"JavaScript\">";
  echo "   var page = \"index.php?mensagem=".$mensagem."\";";
  echo "   location.href=page;";
  echo "</script>";

?>

<? include ($sys_conteudo_sp_url."bottom.php");?>