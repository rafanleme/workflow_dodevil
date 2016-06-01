<style type="text/css">

body { font: normal 11px tahoma,arial,serif; }

table{margin: 0px;}
table,th,td{border-collapse: collapse;}
th,td{;padding: 0px;}
th span{display: block; padding: 3px}
td span{display: block; padding: 3px}
#lista table {width: 1345px;}
#lista th{color: #FFFFFF;text-align: left}
#lista.tabContainer {width: 1350px;}
#lista .scrollContainer {height: 79%;overflow: auto;overflow-x:hidden;}
#lista .tabela-coluna0{width: 9%;}
#lista .tabela-coluna1{width: 12%;}
#lista .tabela-coluna2{width: 22%;}
#lista .tabela-coluna3{width: 20%;}
#lista .tabela-coluna4{width: 13%;}
#lista .tabela-coluna5{width: 7%;}
#lista .tabela-coluna6{width: 9%;}
#lista .tabela-coluna7{width: 8%;}

.divJan{
	border:1px solid black;
	padding:10px;
	
}

#botaoJan {
  background: #ffffff;
  background-image: -webkit-linear-gradient(top, #ffffff, #b3b3b3);
  background-image: -moz-linear-gradient(top, #ffffff, #b3b3b3);
  background-image: -ms-linear-gradient(top, #ffffff, #b3b3b3);
  background-image: -o-linear-gradient(top, #ffffff, #b3b3b3);
  background-image: linear-gradient(to bottom, #ffffff, #b3b3b3);
  border-radius: 10px;
  font-family: Arial;
  color: #black;
  width:100px;
  height:50px;
  padding: 10px 20px 10px 20px;
  border: solid #black 1px;
  text-decoration: none;
}

#botaoJan:hover {
  background: #757575;
  background-image: -webkit-linear-gradient(top, #b3b3b3, #ffffff);
  background-image: -moz-linear-gradient(top, #b3b3b3, #ffffff);
  background-image: -ms-linear-gradient(top, #b3b3b3, #ffffff);
  background-image: -o-linear-gradient(top, #b3b3b3, #ffffff);
  background-image: linear-gradient(to bottom, #b3b3b3, #ffffff);
  text-decoration: none;
}

</style>
<?php
	error_reporting ("E_ALL");
	//print_r($pedidos);
	include("../../class/dao/janelaDao.class.php");
	
	$daoJan = new janelaDao();
	$janDiaria = $daoJan->listaJanelaDiaria();
	
?>
<span style="font-size:12px;">Janela</span>
<div class="divJan">

<input type="button" id="botaoJan" value="Janela 15/04">	
</div>



</div>