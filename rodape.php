<? include ("include/header.php");?>
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
<title>:: TOPO ::</title>
<link href="include/estilo.css" rel="stylesheet" type="text/css">
</head>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 text=white bgcolor=black>
<? echo $ambiente; ?>
<table align=left width="100%" height="100%" cellpadding=0 cellspacing=0 border=0>
<tr><td width="100%" height="100%" align=right valign=middle>

  <div align=left><table width=100% border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td align=left valign=middle width=30%>
      <font color=white size=1 face=Verdana>
        <?
          $dt_dia_semana = traduz_dia_semana(date("l"));
          $dt_dia = date("d");
          $dt_mes = strtolower(traduz_mes(date("F")));
          $dt_ano = date("Y");
          echo "&nbsp; $dt_dia_semana, $dt_dia de $dt_mes de $dt_ano";
        ?>
      </font>
    </td>
    <td align=center valign=middle width=50%>
      <font color=gray size=1 face=Verdana>
      <font color=silver size=1 face=Verdana>WorkFlow</b></font>
      </font>
    </td>
    <td align=right valign=top width=20%>
      <font color="gray" size=1 face=Verdana>
      </font>
    </td>
    <td width=10></td>
    <td></td>
    <td width=20></td>
   </tr>
  </table></div>

</tr>
</table>
</body>
</html>

<? include ("include/bottom.php");?>