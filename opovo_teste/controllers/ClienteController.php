<?php
/**
 * Classe ClienteController
 * Controla o fluxo de dados entre a View (HTML) e o Model (Cliente)
 */

// Inclui os arquivos necessários para o funcionamento do controller
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    
    private $cliente;

    /**
     * Construtor - Inicializa o modelo
     */
    public function __construct() {
        // Como o seu Model (Cliente.php) já faz a conexão com o banco internamente,
        // só precisamos instanciar a classe Cliente aqui.
        $this->cliente = new Cliente();
    }

    /**
     * Método principal (Index) - Lista todos os clientes
     */
    public function index() {
        // Busca os clientes através do Model (que já retorna o array pronto)
        $clientes = $this->cliente->read();

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

            // Tenta salvar no banco de dados chamando a função cadastrar() do Model
            if ($this->cliente->cadastrar()) {
                // Se der certo, redireciona para a lista
                header("Location: index.php?action=listar");
                exit();
            } else {
                echo "Erro ao cadastrar o cliente.";
            }
        }

        // Se não for POST, apenas exibe o formulário de cadastro (o arquivo HTML)
        require_once __DIR__ . '/../views/cadastrar.php';
    }
}
?>