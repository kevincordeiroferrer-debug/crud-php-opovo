<?php

class Cliente {
    private $conn;
    private $table_name = "clientes";

    // Propriedades do modelo correspondentes às colunas do banco
    public $id;
    public $nome;
    public $email;
    public $telefone;
    public $data_cadastro;

    // Substitua o seu construtor atual por este bloco:
    public function __construct() {
        // Chamamos a classe Database diretamente
        $this->conn = Database::getConnection();
    }

    // Método para listar todos os clientes (o controlador chama como read)
    public function read() {
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Método para cadastrar um novo cliente
    public function cadastrar($nome = null, $email = null, $telefone = null) {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $this->conn->prepare($query);

        // Se o controlador usar propriedades ou parâmetros, ambos vão funcionar:
        $nomeFinal = $nome ?? $this->nome;
        $emailFinal = $email ?? $this->email;
        $telefoneFinal = $telefone ?? $this->telefone;

        $stmt->bindParam(":nome", $nomeFinal);
        $stmt->bindParam(":email", $emailFinal);
        $stmt->bindParam(":telefone", $telefoneFinal);

        return $stmt->execute();
    }
}