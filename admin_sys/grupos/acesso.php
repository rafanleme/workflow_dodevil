<?
  $sys_conteudo_sp_url = "../../";
  include($sys_conteudo_sp_url."verifica_sessao.php");
?>
<!--
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
//-->
<html>
<head>
<title><? echo $titulo_pagina;?></title>
<link href="../../include/estilo.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function grupos(){
  document.frm_cadastro.action = "index.php";
  document.frm_cadastro.submit();
}
function voltar(){
  location.href='index.php';
}
function verificar(){
  if(confirm("Deseja salvar as alterações?")){
    document.frm_cadastro.submit();
  }
}
//-->
</script>
</head>
<body bgcolor="white" text="#000000" link="#FF0000" vlink="#800000" alink="#FF00FF" marginwidth=20 marginheight=10 topmargin=10 leftmargin=20 background="<?echo $sys_conteudo_sp_url;?>images/fundo.jpg" bgproperties="FIXED">
<table border=0 cellpadding=0 cellspacing=0 width=100%><tr>
<td id="home" valign=top>
<table border=0 cellpadding=1 cellspacing=2 width=100%>
<tr>
  <td id="titulo2"><b>CADASTRO DE ACESSOS AO GRUPO</b></td>
</tr>
<tr>
  <td HEIGHT=1 BGCOLOR=black></td>
</tr>
</table>

       <font face=verdana color=red size=1><B>
       <? if (!empty($mensagem)){
            echo $mensagem;
          }
       ?>
       </b></font><p>
<form action="aplicar2.php" method="post" name="frm_cadastro">
<input type="hidden" name="acao" value="i">
<input type="hidden" name="sg_id" value="<? echo $sg_id ?>">
<input type="hidden" name="a_sg_nome" value="<? echo $a_sg_nome ?>">
<a href="javascript:grupos();void(0);"><img src="../../images/btn_group.png" border=0 alt="voltar aos grupos"></a>
<b>SISTEMA:</b> <i><font color=green><? echo $a_sg_nome ?></font></i><p>
<font size=1><font color=red><b>ATENÇÃO: </b></font>tipos de acesso: R - somente consulta / W - consulta e alterações</font><p>
<table border=0 cellpadding=1 cellspacing=2>
<!--tr>
  <td valign=top><img src="../../images/btn_key.png" border=0 alt="ID"></td>
  <td id="titulo_conc" valign=top>NOME</td>
  <td id="titulo_conc" valign=top>PATH</td>
  <td id="titulo_conc" valign=top>STATUS</td>
  <td id="titulo_conc" valign=top>OPÇÕES</td>
</tr>
<tr><td width=1 colspan=10 bgcolor=gray></td></tr//-->
<?
  $inst = "SELECT * FROM sys_sistema ORDER BY ss_nome ASC";
  $resu = mysql_query($inst);
  $cont = mysql_num_rows($resu);
  $contador = 0;
  while($valo=mysql_fetch_array($resu)){
     echo "<tr><td id=\"titulo_conc\" valign=top colspan=3 width=216>$valo[ss_nome]</td></tr>";
     $inst2 = "SELECT * FROM sys_ferramenta WHERE sf_sf_id=0 AND sf_ss_id=".$valo["ss_id"]." ORDER BY sf_nome ASC";
     $resu2 = mysql_query($inst2);
     $cont2 = mysql_num_rows($resu2);
     while($valo2=mysql_fetch_array($resu2)){
        echo "<tr class=\"lktb_item\"><td valign=top id=\"home3\"><img src=\"../../images/btn_tool.png\" border=0 alt=\"ferramenta\"><b>".$valo2["sf_nome"]."</b></td><td id=\"home3\" valign=top><img src=\"../../images/btn_getaccess.png\" border=0 alt=\"Têm acesso?\"></td><td id=\"home3\" valign=top><img src=\"../../images/btn_alert.png\" border=0 alt=\"Qual tipo de acesso?\"></td></tr>";
        $inst3 = "SELECT * FROM sys_ferramenta WHERE sf_sf_id=".$valo2["sf_id"]." ORDER BY sf_nome ASC";
        $resu3 = mysql_query($inst3);
        $cont3 = mysql_num_rows($resu3);
        while($valo3 = mysql_fetch_array($resu3)){
           $valor_check = $sg_id."#".$valo3["sf_id"]."#".$valo3["sf_sf_id"]."#".$valo3["sf_ss_id"];
           $inst_get = "SELECT * FROM sys_acesso WHERE sa_sg_id=".$sg_id." AND sa_sf_id=".$valo3["sf_id"]." AND sa_sf_sf_id=".$valo3["sf_sf_id"]." AND sa_ss_id=".$valo3["sf_ss_id"].";";
           $resu_get = mysql_query($inst_get);
           $valo_get = mysql_fetch_array($resu_get);
           $cont_get = mysql_num_rows($resu_get);
           if ($cont_get>0){
              $campo_sel = "checked";
              if ($valo_get["sa_tipo"]=="R"){
                 $tipo_r = "selected";
                 $tipo_w = "";
              } else {
                 $tipo_r = "";
                 $tipo_w = "selected";
              }
           } else {
              $campo_sel = "";
              $tipo_r = "selected";
              $tipo_w = "";
           }           
           echo "<tr class=\"lktb_item\"><td valign=top id=\"home3\" width=184><img src=\"../../images/btn_subtool.png\" border=0 alt=\"sub-ferramenta\">".$valo3["sf_nome"]."</td>";
           echo "<td valign=top id=\"home3\" width=16><input type=\"checkbox\" name=\"check_".$contador."\" value=\"$valor_check\" id=\"input_nada\" $campo_sel></td>";
           echo "<td valign=top id=\"home3\" width=16><select name=\"select_".$contador."\"><option value=\"R\" style=\"color:green;\" $tipo_r>R</option><option value=\"W\" style=\"color:red;\" $tipo_w>W</option></select></td></tr>";
           $contador++;
        }
     }
     if ($cont2==0){
        echo "<tr><td colspan=3 id=home3><font color=silver>Não existe ferramentas nesse sistema!</font></td></tr>";
     }
     echo "<tr><td colspan=2>&nbsp;</td></tr>";
  }
  $contador = $contador-1;
?>
<tr>
  <td colspan="3" align="center">&nbsp;<br>
  <input type="button" name="entrar" value="salvar" id="input_btn_send" onclick="verificar();">
  <input type="button" name="cancelar" value=" cancelar " id="input_btn_excluir" onclick="voltar();">
  &nbsp; &nbsp; 
</td></tr>
</table>
<input type="hidden" name="contador" value="<?echo $contador;?>">
</form>

</td>
</tr></table>
</body>
</html>
<? include ($sys_conteudo_sp_url."bottom.php");?>