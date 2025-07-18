<?php
include_once __DIR__ . '/../config/Database.php';

class UsuarioModel {
    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function verificarCredenciales($email, $contrasena) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email AND contrasena = :contrasena LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $email, $contrasena) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":contrasena", $contrasena);
        return $stmt->execute();
    }

    public function obtenerUsuarios() {
        $query = "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.email, roles.nombre_rol AS rol 
                  FROM " . $this->table_name . " 
                  JOIN roles ON usuarios.id_rol = roles.id_rol";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id_usuario) {
        $query = "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.email,usuarios.contrasena, usuarios.id_rol, roles.nombre_rol 
                  FROM usuarios 
                  JOIN roles ON usuarios.id_rol = roles.id_rol
                  WHERE usuarios.id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id_usuario, $nombre, $email, $id_rol) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, email = :email, id_rol = :id_rol
                  WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id_rol", $id_rol);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function obtenerRoles() {
        $query = "SELECT id_rol, nombre_rol FROM roles";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($nombre, $email, $contrasena, $id_rol) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, email, contrasena, id_rol) 
                  VALUES (:nombre, :email, :contrasena, :id_rol)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->bindParam(":id_rol", $id_rol);
        return $stmt->execute();
    }

    public function obtenerDatosUsuarioPorId($id_usuario) {
        $query = "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.email, usuarios.contrasena, usuarios.fecha_registro, roles.nombre_rol 
                  FROM " . $this->table_name . " 
                  JOIN roles ON usuarios.id_rol = roles.id_rol 
                  WHERE usuarios.id_usuario = :id_usuario LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPerfilPorId($id_usuario, $nombre, $email, $contrasena) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, email = :email, contrasena = :contrasena WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Method to get user preferences for theme and notifications
    public function obtenerPreferencias($id_usuario) {
        $query = "SELECT theme, notifications FROM usuarios WHERE id_usuario = :id_usuario LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update user preferences for theme and notifications
    public function actualizarPreferencias($id_usuario, $theme, $notifications) {
        $query = "UPDATE usuarios SET theme = :theme, notifications = :notifications WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":theme", $theme);
        $stmt->bindParam(":notifications", $notifications, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function actualizarContrasenaPorId($id_usuario, $contrasena) {
        $sql = "UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql); // Usa tu conexión a la base de datos
        return $stmt->execute([$contrasena, $id_usuario]);
    }
    
}
