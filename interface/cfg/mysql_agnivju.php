<?php
## Fun��es MYSQL

//Fun��o Conectar ao Bd
function dbcon () {
$server = "localhost"; // Host do Server
$lgbd = "root"; // Login do banco de dados
$passbd = ""; // Senha do banco de dados


return mysql_connect($server,$lgbd,$passbd);

}

//Fun��o Select Bd
function dbsel () 
{

$bd = "etrporju"; // Nome da base de dados

return mysql_select_db($bd);

}

?>