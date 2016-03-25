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


</style>
<?php
	error_reporting ("E_ALL");
	include("../../class/dao/pedidoDao.class.php");
	include("../../class/uteis.class.php");
	$objGrid = new pedidoDao();
	$pedidos = $objGrid->pedidosJanela($_GET['data']);
	$uteis = new uteis();
	//print_r($pedidos);
	
?>
<div class="tabContainer" id="lista">
	
		<table class="tbresumo" style="width:1339px"  >
		<thead>
		<tr>
		<td colspan="7" style="background-color:EEEEEE;">Total de Pedidos: <b><?//echo $cont?></b></td>
		<td align="center" style="background-color:EEEEEE;"><a href="index.php"><img src="../../images/btn_refresh.png"></a></td>
		</tr>
		<tr>
		  <th class="tabela-coluna0" valign=middle>Data de integração</td>
		  <th class="tabela-coluna1" valign=middle>Referência</td>
		  <th class="tabela-coluna2" valign=middle NOWRAP>Cliente</td>
		  <th class="tabela-coluna3" valign=middle NOWRAP>Endereço Entrega</td>			  
		  <th class="tabela-coluna4" valign=middle NOWRAP>Cidade-UF Entrega</td>
		  <th class="tabela-coluna5" valign=middle NOWRAP>Rota/Ordem</td>
		  <th class="tabela-coluna6" valign=middle NOWRAP>Estado</td>
		  <th class="tabela-coluna7" valign=middle>Arquivo</td>
		</tr>
		</thead>
		</table>
	
<div class="scrollContainer">
<table class="tbResumo" style="table-layout:fixed;" >
<tbody>
<?php
	$difLinha = '0';
	$i = 0;
	foreach($pedidos as $pedido){
?>
<tr id="pedido<?php echo($i); ?>" onclick="gridSel(<?php echo($i); ?>,'conta')">
	<td class="tabela-coluna0"  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>">
		<p title="<?php echo $pedido['datped'];?>"><?php echo $pedido['datped'];?></p>
	</td>                                                       
	<td class="tabela-coluna1"                                  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>">
		<p title="<?php echo $pedido['refped'];?>"><?php echo $pedido['refped']?>         </p>                 
	</td>                                                       
	<td class="tabela-coluna2"                                  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>" NOWRAP>
		<p title="<?php echo utf8_decode($pedido['nomcli']);?>"><?php echo utf8_decode($uteis->strGrid($pedido['nomcli'],46));?> </p>              
	</td>                                                       
	<td class="tabela-coluna3"                                  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>" NOWRAP>
		<p title="<?php echo utf8_decode($pedido['endent']);?>"><?php echo utf8_decode($uteis->strGrid($pedido['endent'],40));?>             
	</td>                                                       
	<td class="tabela-coluna4" nowrap="nowrap"                  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>" NOWRAP>
		<p title="<?php echo utf8_decode($pedido['cident']." - ".$pedido['estent']);?>">
			<?php echo utf8_decode($pedido['cident']." - ".$pedido['estent'])?>             
	</td>                                                       
	<td class="tabela-coluna5" nowrap="nowrap"                  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>" NOWRAP>
		    <?php 
				if(!empty($pedido['rotped'])){
					echo $pedido['rotped']."/".str_pad($pedido['ordped'], 3, "0", STR_PAD_LEFT);
				}
			?>
	</td>                                                       
	<td class="tabela-coluna6" nowrap="nowrap"                  
		style="background-color:<?php if($difLinha != '0')echo('#EEEEEE');else echo('white');?>">
		    <?php echo utf8_decode($pedido['desest'])?>
	</td>                                                       
	<td class="tabela-coluna7" 
		style="background-color:<?php if($difLinha != '0'){$difLinha = '0';echo('EEEEEE');}else{echo('white');$difLinha = "1";}?>">
			<a href="../../integracao/M50/<?php echo $pedido['arqped'];?>" title="Baixar Arquivo" download><?php echo utf8_decode(substr($pedido['arqped'],25,1000)); ?>
	</td>
</tr>
<?php
	$i++;
	}
?>

<tr><td width=100% height=1 colspan=25><img src="../../images/gray1px.gif" width=100% height=1 border=0></td></tr>
</tbody>
</table>
</div>
</div>