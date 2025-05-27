<?php

class Conexao
{
    private $driver;
    private $host;
    private $banco;
    private $usuario;
    private $senha;
    private $debug = false;

    public function __construct()
    {
        $this->driver = "mysql";
        $this->host = "localhost";
        $this->banco = "blogdb";
        $this->usuario = "root";
        $this->senha = "";
    }

    public function getConexao()
    {
        $conexao = null;
        try {
            $conexao = new PDO("$this->driver:host=$this->host;dbname=$this->banco", $this->usuario, $this->senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Problemas de conexão, volte mais tarde';
            if ($this->debug == true) {
                echo $e->getMessage();
            }
            exit;
        }

        return $conexao;
    }
    public function setDebug($novoDebug)
    {
        $this->debug = $novoDebug;
    }
}
