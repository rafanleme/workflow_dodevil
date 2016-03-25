<?php
$sys_conteudo_sp_url = "../";

require_once("../class/dao/pedidoDao.class.php");
require_once("../class/pedidoAS400DAO.class.php");

class interface_pedido extends dbConn
{
    private $myConn = NULL;
    public $filterRows = NULL;
    public $orderRows = NULL;
    public $totRows = NULL;
    public $erro = NULL;
    
    function interface_sispcp()
    {
        $this->myConn = dbConn::dbOpen();
    }

    function interface_sispcpDBClose()
    {
      	$this->myConn = dbConn::dbClose();
    }

    function __destruct()
    {
      	$this->myConn = dbConn::dbClose();
    }
	
	
	
    public function rotinaPedidos(){
		
		$daoPed = new pedidoDao();
		$daoAS400 = new pedidoAS400DAO();
		
		$pedidos = $daoAS400->verificaPedidos($daoPed->listarPedidosSemRota());
		
		$daoPed->atualizarRotaPedidos($pedidos);
		
	}
}

error_reporting (E_ALL);
echo "==================================================\n";
echo "       EXECUTANDO INTERFACE AGNIVJU SISPCP        \n";
echo "==================================================\n";

$rotina = new interface_pedido();

$rotina->rotinaPedidos();