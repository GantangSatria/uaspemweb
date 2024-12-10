<?php
require_once 'config/db_con.php';

class Phone {
    private $connection;
    private $table = 'phones';

    public function __construct($db) {
        $this->connection = $db;
    }

    public function getAllPhones() {
        $stmt = $this->connection->prepare("SELECT * FROM phones");
        $stmt->execute();
        $result = $stmt->get_result();
        $phones = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $phones;
    }

    public function addPhone($brand, $name, $price, $release_year, $description, $image_path) {
        $stmt = $this->connection->prepare('INSERT INTO phones (brand, name, price, release_year, description, image_path) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssdsss', $brand, $name, $price, $release_year, $description, $image_path);
        return $stmt->execute();
    }

    public function updatePhone($brand, $name, $price, $release_year, $description, $image_path, $phone_id) {
        $stmt = $this->connection->prepare('UPDATE phones SET brand = ?, name = ?, price = ?, release_year = ?, description = ?, image_path = ? WHERE phone_id = ?');
        $stmt->bind_param('ssdsssi', $brand, $name, $price, $release_year, $description, $image_path, $phone_id);
        return $stmt->execute();
    }

    public function deletePhone($phone_id) {
        $query = "DELETE FROM phones WHERE phone_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $phone_id);
        return $stmt->execute();
    }

    public function getPhoneById($phone_id) {
        $query = "SELECT * FROM phones WHERE phone_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $phone_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}