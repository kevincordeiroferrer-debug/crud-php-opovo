<?php
/**
 * Classe ClienteController
 * Controla o fluxo de dados entre a View (HTML) e o Model (Cliente)
 */

// Inclui os arquivos necessários para o funcionamento do controller
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    
    private $db;
    private $cliente;

    /**
     * Construtor - Inicializa a conexão com o banco e o modelo
     */
    public function __construct() {
        $this->db = Database::getConnection();
        $this->cliente = new Cliente($this->db);
    }

    /**
     * Método principal (Index) - Lista todos os clientes
     */
    public function index() {
        // Busca os clientes através do Model
        $stmt = $this->cliente->read();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Envia os dados para a View de listagem
        require_once __DIR__ . '/../views/listar.php';
    }

    /**
     * Método para cadastrar um novo cliente
     */
    public function cadastrar() {
        // Verifica se o formulário foi enviado via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Captura e atribui as propriedades ao modelo
            $this->cliente->nome = $_POST['nome'] ?? '';
            $this->cliente->email = $_POST['email'] ?? '';
            $this->cliente->telefone = $_POST['telefone'] ?? '';

            // Tenta salvar no banco de dados
            if ($this->cliente->create()) {
                // Se der certo, redireciona para a lista com uma mensagem de sucesso
                header("Location: index.php?action=listar&sucesso=1");
                exit();
            } else {
                echo "Erro ao cadastrar o cliente.";
            }
        }

        // Se não for POST, apenas exibe o formulário de cadastro
        require_once __DIR__ . '/../views/cadastrar.php';
    }
}
?>