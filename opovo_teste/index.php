<?php
require_once __DIR__ . '/config/Database.php';
/**
 * Arquivo Index - Ponto de entrada único da aplicação (Front Controller)
 */

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/Cliente.php';
require_once __DIR__ . '/controllers/ClienteController.php';

// Instancia o controller de clientes
$controller = new ClienteController();

// Captura a ação que o usuário quer executar (se não houver nenhuma, o padrão é 'listar')
$action = $_GET['action'] ?? 'listar';

// Roteamento simples baseado na ação
switch ($action) {
    case 'cadastrar':
        $controller->cadastrar();
        break;
        
    case 'listar':
    default:
        $controller->index();
        break;
}
?>