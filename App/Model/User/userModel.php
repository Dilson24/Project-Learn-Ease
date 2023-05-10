<!--Ejemplo de modelo para usuario -->

<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=mydatabase", "username", "password");
    }

    // Obtener todos los usuarios
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un usuario por su ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public function createUser($name, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        return $this->db->lastInsertId();
    }

    // Actualizar un usuario existente
    public function updateUser($id, $name, $email, $password) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$name, $email, $password, $id]);
        return $stmt->rowCount();
    }

    // Eliminar un usuario por su ID
    public function deleteUserById($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
