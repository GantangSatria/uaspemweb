<?php

class usercontroller{
    private $db;
    private $user;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $user = $this->user->login($username);
            $_SESSION['user_id'] = $user['user_id']; 
            $_SESSION['username'] = $user['username']; 
            header("Location: index.php"); 

        } else { 
            $error = "Username atau password salah!"; 
        } 
        require_once('Views/auth/login.php');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = ($_POST['username']);
            $password = ($_POST['password']);
        
            if (empty($username) || empty($password)) {
                $error = "Username dan password tidak boleh kosong!";
            } elseif (strlen($username) < 3) {
                $error = "Username harus minimal 3 karakter!";
            } elseif (strlen($password) < 4) {
                $error = "Password harus minimal 4 karakter!";
            } else {
                $result = $this->user->cekUser($username);
                if ($result->num_rows > 0) {
                    $error = "Username sudah terdaftar!";
                } else {
                    $this->user->register($username,$password);
        
                    $_SESSION['success_message'] = "Akun berhasil dibuat!";
        
                    header('Location: index.php');
                }
            }
        }
        require_once('Views/auth/register.php');
    }

    public function logout(){
        session_destroy();
        require_once('Views/auth/login.php');
    }
}