<?php

/**
 * Classe responsável pela conexão com o banco de dados.
 * Aplica o padrão de projeto Singleton para garantir uma única instância ativa.
 */
class Database {
    
    private static $host = "localhost";
    private static $db_name = "crud_clientes";
    private static $username = "root"; 
    private static $password = "";     
    private static $conn = null;

    /**
     * Estabelece e retorna a conexão PDO com o banco de dados.
     * @return PDO|null Retorna a instância PDO ou exibe erro em caso de falha.
     */
    public static function getConnection() {
        if (self::$conn == null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4";
                self::$conn = new PDO($dsn, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception) {
                echo "Erro de conexão: " . $exception->getMessage();
            }
        }
        return self::$conn;
    }
}
?>