<? include ("include/header.php");
  session_unregister("ses_login");
  session_unregister("ses_nome");
  session_unregister("ses_senha");
  session_unregister("ses_ok");
  session_unregister("ses_tipo");
?>
<!--
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
//-->

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>:: LOGIN ::</title>
<script language=JavaScript>
<!--
 function campoCheck(camp){
   if ((camp=="")||(camp==" ")){
     return false;
   } else {
     return true;
   }
 }

 function verifica(){
   var erro="sem";
   campos="";

   if (campoCheck (document.f_login.login.value)==false) {
     erro="com";
     if (campos==""){
       campos = "  -> Usuário";
     } else {
       campos = campos + "\n  -> Usuário";
     }
   }

   if (campoCheck (document.f_login.senha.value)==false) {
     erro="com";
     if (campos==""){
       campos = "  -> Senha";
     } else {
       campos = campos + "\n  -> Senha";
     }
   }

   if (erro=="sem"){
     document.f_login.submit();
   } else {
     alert("Por favor preencha corretamente os campos:\n"+campos);
   }
 }
 function muda_foco(thisEvent,nome_componente){
   var kCode = (navigator.appName == "Netscape") ? thisEvent.which : thisEvent.keyCode;
   if (kCode ==13){
     if (nome_componente=="login"){
        document.f_login.senha.focus();
     } else if(nome_componente=="senha"){
        document.f_login.submit();
     }
   }
 }
 <? if (!empty($mensagem)){
      echo "var msg = '?mensagem=".$mensagem."';\n";
    }
 ?>
 var sW = screen.width;
 var sH = screen.height;
 if(sW<640){
  location.href = 'login_rf.php'+msg;
 }
//-->
</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />
<link href="include/custom_header.css" rel="stylesheet">
</head>
<body class="body-bg" onLoad="document.f_login.login.focus();">
  <div id="header-wrapper" class="header-wrapper">
    <div id="header-content" class="header-content">
      <div class="header-login">
        <form name="f_login" id="f_login" method="post" action="verifica_login.php">
          <input type="hidden" name="rf" value="0">
          <input type="text" name="login" value="" id="login" placeholder="Login" onkeypress="muda_foco(event,'login');">
          <input type="password" name="senha" value="" id="senha" placeholder="Senha" onkeypress="muda_foco(event,'senha');">
          <input type="button" name="entrar" value="Entrar" id="bt-entrar" onclick="verifica();">
          <span id="header-login-msg" class="msg-error" style="display: <?=(!empty($_REQUEST['mensagem'])>0) ? 'block' : 'none'?>;"><?=$_REQUEST['mensagem']?></span>
        </form>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">

</script>
  <? echo $ambiente; ?>
</html>

<? include ("include/bottom.php");?>