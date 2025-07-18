<?php
include_once __DIR__ . '/../config/Database.php';

class PermisoModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los permisos disponibles
    public function obtenerPermisos() {
        $query = "SELECT * FROM permisos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener permisos asignados a un rol específico
    public function obtenerPermisosPorRol($id_rol) {
        $query = "SELECT id_permiso FROM roles_permisos WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Actualizar los permisos asignados a un rol
    public function actualizarPermisosPorRol($id_rol, $permisos) {
        // Primero eliminar todos los permisos actuales del rol
        $query = "DELETE FROM roles_permisos WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $stmt->execute();

        // Insertar los permisos seleccionados
        $query = "INSERT INTO roles_permisos (id_rol, id_permiso) VALUES (:id_rol, :id_permiso)";
        $stmt = $this->conn->prepare($query);
        foreach ($permisos as $id_permiso) {
            $stmt->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(":id_permiso", $id_permiso, PDO::PARAM_INT);
            $stmt->execute();
        }
        return true;
    }
}
?>
