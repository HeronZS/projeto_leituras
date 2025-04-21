<?php
class Database {
    
    private $host = 'localhost';
    private $db_name = 'leituras';
    private $username = 'postgres';
    private $password = 'admin';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $dsn = "pgsql:host={$this->host};dbname={$this->db_name}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>