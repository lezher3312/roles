<?php
require_once __DIR__ . '/../config/Database.php';


class ClienteModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerClientes() {
        $stmt = $this->conn->query("SELECT * FROM clientes ORDER BY fecha_registro DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerClientePorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardarCliente($data) {
        $sql = "INSERT INTO clientes (nombre, direccion, telefono, correo, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['nombre'], $data['direccion'], $data['telefono'], $data['correo'], $data['estado']
        ]);
    }

    public function actualizarCliente($id, $data) {
        $sql = "UPDATE clientes SET nombre = ?, direccion = ?, telefono = ?, correo = ?, estado = ? WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['nombre'], $data['direccion'], $data['telefono'], $data['correo'], $data['estado'], $id
        ]);
    }

    public function eliminarCliente($id) {
        $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id_cliente = ?");
        return $stmt->execute([$id]);
    }
}
?>
