<?php
class User {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy 1 user theo username
    public function find($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tạo user mới
    public function create($username, $email, $password) {
        $sql = "INSERT INTO users(username, email, password) 
                VALUES(?,?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        return $stmt->execute();
    }
}
