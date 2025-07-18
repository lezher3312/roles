<?php
class Database {
    private $host = "82.197.82.30";
    private $db_name = "u483752107_login"; // Cambia por el nombre de tu base de datos
    private $username = "u483752107_login1"; // Cambia por tu usuario de la base de datos
    private $password = "Josh3312@"; // Cambia por tu contraseña de la base de datos
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
