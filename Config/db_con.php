<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "phones_store";
    private $port = 3307;
    private $connection;

    public function __construct() {
        $this->connection = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname,
            $this->port
        );

        if ($this->connection->connect_error) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        $this->connection->close();
    }
}
?>
