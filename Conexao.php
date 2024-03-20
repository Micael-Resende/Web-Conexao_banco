<?php
class Conexao {
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $port, $database, $username, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function conectar() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            echo "Falha na conexão: " . $e->getMessage();
            return false;
        }
    }

    public function desconectar() {
        $this->pdo = null;
    }

    public function executar($query) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erro ao executar a consulta: " . $e->getMessage();
            return false;
        }
    }

    public function inserir($nome, $ticker, $valor, $quantidade, $data) {
        try {
            $query = "INSERT INTO fundos (nome, ticker, valor, quantidade, data) VALUES (:nome, :ticker, :valor, :quantidade, :data)";
            $stmt = $this->pdo->prepare($query);
            
            // Associa os valores aos parâmetros da consulta
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':ticker', $ticker);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':data', $data);
            
            // Executa a consulta
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
