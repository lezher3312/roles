<?php
include_once __DIR__ . '/../config/Database.php';

class Modulo {
    private $conn;
    private $table_name = "modulos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerTodosLosModulos() {
        $query = "SELECT id_modulo, nombre, ruta FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerModuloPorId($id_modulo) {
        $query = "SELECT id_modulo, nombre, ruta FROM " . $this->table_name . " WHERE id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_modulo", $id_modulo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearModulo($nombre, $ruta) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, ruta) VALUES (:nombre, :ruta)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":ruta", $ruta);
        return $stmt->execute();
    }

    public function actualizarModulo($id_modulo, $nombre, $ruta) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, ruta = :ruta WHERE id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":ruta", $ruta);
        $stmt->bindParam(":id_modulo", $id_modulo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function borrarModulo($id_modulo) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_modulo", $id_modulo, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
