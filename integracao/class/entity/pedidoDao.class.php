<?php
class usuariosVO{
    /*Método construtor da classe*/
    public function __construct(){}
     
    /*Evita que a classe seja clonada*/
    private function __clone(){}
     
    /*Método destrutor da classe*/
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach(array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }
     
    /*Variáveis privadas que receberão os dados*/
    private $codcli = 0;
    private $datcli = "";
    private $ = "";
    private $senha = "";
     
    /*Metodos get e set que trazem o conteudo da variável privada desejada*/
    public function getId(){
        return $this->id;
    }
    public function setId($codcli){
        $this->id = intval($codcli);
    }
     
    public function getNome(){
        return $this->nome;
    }
    public function setNome($datcli){
        $this->nome = $datcli;
    }
     
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login = $login;
    }
     
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
}
?>


Read more: http://www.linhadecodigo.com.br/artigo/3476/mapeamento-objeto-relacional-vo-em-php.aspx#ixzz3vAC5mAZD