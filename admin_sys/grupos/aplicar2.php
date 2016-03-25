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
  $sql="";$sql2="";
  if ($acao=="i"){
     $sql2 = "DELETE FROM sys_acesso WHERE sa_sg_id=".$sg_id;
     if (!mysql_query($sql2)){
       $mensagem="Ocorreu um erro ao limpar acesso, contate o administrador.";
       break;
     }
     for($x=0;$x<$contador+1;$x++){
        $campo1 = "check_".$x;
        $campo2 = "select_".$x;
        $valores = explode("#",$$campo1);
        if (!empty($$campo1)){
           $apoio = "INSERT INTO sys_acesso SET ";
           $sql = $apoio." sa_sg_id=".$valores[0];
           $sql .= ", sa_sf_id=".$valores[1];
           $sql .= ", sa_sf_sf_id=".$valores[2];
           $sql .= ", sa_ss_id=".$valores[3];
           $sql .= ", sa_tipo='".$$campo2."' ".$apoio2;
           $mensagem = "Acesso do grupo alterado com sucesso!";
           if (!mysql_query($sql)){
              $mensagem="Ocorreu um erro, contate o administrador.";
              break;
           }
        }
     }
  }
  echo "<script language=\"JavaScript\">";
  echo "   var page = \"index.php?mensagem=".$mensagem."\";";
  echo "   location.href=page;";
  echo "</script>";
?>

<? include ($sys_conteudo_sp_url."bottom.php");?>