<?php
require_once '../../../config/Database.php'; // ← nuevo nombre correcto

class GestionPermisosModel {
    private $pdo;

    public function __construct() {
        $db = new Database();
$this->pdo = $db->getConnection(); // ← sigue siendo "conexion" como nombre de clase
    }

    public function obtenerRoles() {
        $stmt = $this->pdo->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerModulos() {
        $stmt = $this->pdo->query("SELECT * FROM modulos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPermisos() {
        $stmt = $this->pdo->query("SELECT * FROM permisos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPermisosPorRol($id_rol) {
    $stmt = $this->pdo->prepare("SELECT * FROM gestion_proles WHERE id_rol = ?");
    $stmt->execute([$id_rol]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function obtenerPermisosPorRolYModulo($id_rol, $modulo_nombre) {
    $sql = "SELECT p.nombre_permiso
            FROM gestion_proles gp
            JOIN permisos p ON gp.id_permiso = p.id_permiso
            JOIN modulos m ON gp.id_modulo = m.id_modulo
            WHERE gp.id_rol = :id_rol AND m.nombre = :modulo";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        ':id_rol' => $id_rol,
        ':modulo' => $modulo_nombre
    ]);
    
    return $stmt->fetchAll(PDO::FETCH_COLUMN); // Retorna un array con ['ver', 'editar', ...]
}


    public function obtenerPermisosAsignados($id_rol) {
        $stmt = $this->pdo->prepare("SELECT * FROM gestion_proles WHERE id_rol = ?");
        $stmt->execute([$id_rol]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardarPermisos($id_rol, $permisos) {
        $stmt = $this->pdo->prepare("DELETE FROM gestion_proles WHERE id_rol = ?");
        $stmt->execute([$id_rol]);

        $stmt = $this->pdo->prepare("INSERT INTO gestion_proles (id_rol, id_modulo, id_permiso) VALUES (?, ?, ?)");
        foreach ($permisos as $id_modulo => $acciones) {
            foreach ($acciones as $id_permiso) {
                $stmt->execute([$id_rol, $id_modulo, $id_permiso]);
            }
        }
    }

public function obtenerModulosAsignadosAlRol($id_rol) {
    $sql = "SELECT m.* 
            FROM modulos m 
            INNER JOIN roles_modulos rm ON m.id_modulo = rm.id_modulo 
            WHERE rm.id_rol = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id_rol]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
