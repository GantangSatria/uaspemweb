<?php
// models/User.php
require_once 'config/db_con.php';

class User {
    private $connection;
    private $table = 'users';

    public function __construct($db) {
        $this->connection = $db;
    }

    public function login($username) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function register($username, $password) {
        $stmt = $this->connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        return $stmt->execute();
    }

    public function cekUser($username){
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result();
    }
}