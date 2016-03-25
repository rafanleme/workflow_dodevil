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

<html>
<head>
<title>:: LOGIN ::</title>
<link href="include/estilo.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
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
</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 text=blue bgcolor=black onLoad="document.f_login.login.focus();">
<table align=center width="100%" height="100%" cellpadding=0 cellspacing=0 border=0>
<tr><td width="100%" height="100%" align=center valign=middle>
<div align="center">
<form method="post" action="verifica_login.php" name="f_login">
<input type='hidden' name='rf' value='0'>
  <table border="0" cellspacing="0" cellpadding="0" bgcolor=#E8E8E8 width=300 background="images/mapa.jpg">
   <tr>
     <td align=center valign=middle colspan=10><img src="images/login_logo.png" border=0></td>
   </tr>
   <tr><td height=2 width=100% bgcolor=black colspan=10></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr>
     <td align=center valign=middle width=400 >


  <table border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td colspan=2 id="label">
       <font face=verdana color=red size=1><B>
       <? if (!empty($_REQUEST["mensagem"])){
            echo $_REQUEST["mensagem"];
          }
       ?>
       </b></font>
    </td>
   </tr>
   <tr>
    <td height="25" width=80 id="label"><font face="Verdana" size="2"><b>Usuário:</b></font></td>
    <td><font face="Verdana" size="2"><input type="text" name="login" size=14 style="font-size: 8 pt; font-family: Verdana; color:#34497E; text-transform:none;" onkeypress="muda_foco(event,'login');"></font></td>
   </tr>
   <tr>
    <td height="25" id="label"><font face="Verdana" size="2"><b>Senha:</b></font></td>
    <td><font face="Verdana" size="2"><input type="password" size=14 name="senha" style="font-size: 8 pt; font-family: Verdana; color:#34497E; text-transform:none;" onkeypress="muda_foco(event,'senha');"></font></td>
   </tr>
   <tr>
     <td colspan="2" align="center">&nbsp;<br>
     <input type="button" name="entrar" value=" entrar " id="input_btn_send" onclick="verifica();">
     <input type="button" name="cancelar" value=" cancelar " id="input_btn_excluir" onclick="this.form.reset();">
     &nbsp; &nbsp;
   </td></tr>
   <tr><td>&nbsp;</td></tr>
  </table>
 </td>
 <td width=100 align=center valign=bottom>
   <img src="images/logo_nivea.png" height=60 border=0><br>&nbsp;
 </td>

   </tr>
  </table>
  <? echo $ambiente; ?>


</form>
</div>
</tr>
</table>
</body>
</html>

<? include ("include/bottom.php");?>