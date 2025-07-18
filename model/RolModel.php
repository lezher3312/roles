<?php
include_once __DIR__ . '/../config/Database.php';

class RolModel {
    private $conn;
    private $table_name = "roles";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerRoles() {
        $query = "SELECT id_rol, nombre_rol, descripcion FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRolPorId($id_rol) {
        $query = "SELECT id_rol, nombre_rol, descripcion FROM " . $this->table_name . " WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearRol($nombre_rol, $descripcion) {
        $query = "INSERT INTO " . $this->table_name . " (nombre_rol, descripcion) VALUES (:nombre_rol, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_rol", $nombre_rol);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function actualizarRol($id_rol, $nombre_rol, $descripcion) {
        $query = "UPDATE " . $this->table_name . " SET nombre_rol = :nombre_rol, descripcion = :descripcion WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre_rol", $nombre_rol);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarRol($id_rol) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function obtenerAccesosPorRolModulo() {
        $query = "SELECT id_rol, id_modulo FROM roles_modulos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function asignarModuloARol($id_rol, $id_modulo) {
        $query = "SELECT * FROM roles_modulos WHERE id_rol = :id_rol AND id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol);
        $stmt->bindParam(":id_modulo", $id_modulo);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            $query = "INSERT INTO roles_modulos (id_rol, id_modulo) VALUES (:id_rol, :id_modulo)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_rol", $id_rol);
            $stmt->bindParam(":id_modulo", $id_modulo);
            $stmt->execute();
        }
    }

    public function obtenerModulosPorRol($id_rol) {
        $query = "SELECT modulos.nombre, modulos.ruta
                  FROM modulos
                  INNER JOIN roles_modulos ON modulos.id_modulo = roles_modulos.id_modulo
                  WHERE roles_modulos.id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result); // Para verificar los módulos obtenidos
        return $result;
    }
    
    public function removerModuloDeRol($id_rol, $id_modulo) {
        $query = "DELETE FROM roles_modulos WHERE id_rol = :id_rol AND id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(":id_modulo", $id_modulo, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    

}
