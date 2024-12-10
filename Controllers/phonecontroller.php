<?php

class PhoneController {
    private $db;
    private $phoneModel;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->phoneModel = new Phone($this->db);
    }

    public function index() {
        $phones = $this->phoneModel->getAllPhones();
        require_once __DIR__ . '/../Views/phones/index.php';
    }
    
    public function addPhone() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brand = $_POST['brand'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $release_year = $_POST['release_year'];
            $description = $_POST['description'];
            $image_path = $this->uploadImage($_FILES['image']);

            if ($this->phoneModel->addPhone($brand, $name, $price, $release_year, $description, $image_path)) {
                header('Location: index.php');
                exit();
            }
        }
        require_once 'Views/phones/tambah_barang.php';
    }

    public function updatePhone() {
        if (isset($_GET['phone_id']) && is_numeric($_GET['phone_id'])) {
            $phone_id = $_GET['phone_id'];
        
            $phone =$this->phoneModel->getPhoneById($phone_id);
            if (!$phone) {
                echo "Phone not found!";
                exit();
            }
        } else {
            echo "No phone ID specified!";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brand = $_POST['brand'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $release_year = $_POST['release_year'];
            $description = $_POST['description'];
            $image_path = $phone['image_path'];
        
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                if (file_exists('Assets/'.$image_path)) {
                    unlink("Assets/".$image_path);
                }
        
                $image_path = $this->uploadImage($_FILES['image']);
            }
        
            if ($this->phoneModel->updatePhone($brand, $name, $price, $release_year, $description, $image_path, $phone_id)) {
                header('Location: index.php');
                exit();
            }
        };
        require_once 'Views/phones/update.php';
    }

    public function deskripsiPhone(){
        if (isset($_GET['phone_id']) && is_numeric($_GET['phone_id'])) {
            $phone_id = $_GET['phone_id'];
        
            $phone =$this->phoneModel->getPhoneById($phone_id);
            if (!$phone) {
                echo "Phone not found!";
                exit();
            }
        } else {
            echo "No phone ID specified!";
            exit();
        }
        require_once 'Views/phones/deskripsi.php';
    }

    public function delete($phone_id) {
        if (isset($_GET['phone_id']) && is_numeric($_GET['phone_id'])) {
            $phone_id = $_GET['phone_id'];
        
            $phone =$this->phoneModel->getPhoneById($phone_id);
            
            if ($phone) {
                if (file_exists('Assets/'.$phone['image_path'])) {
                    unlink('Assets/'.$phone['image_path']);
                }
        
            if($this->phoneModel->deletePhone($phone_id)) {
                    header('Location: index.php');
                    exit();
                }
            } else {
                echo "Phone not found!";
            }
        } else {
            echo "No phone ID specified!";
            exit();
        }
        require_once 'Views/phones/tambah_barang.php';
    }

    public function getPhoneById($phone_id) {
        return $this->phoneModel->getPhoneById($phone_id);
    }

    public function uploadImage($file) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

            $target_dir = "Assets/";
            $fileName = "upload/" . basename($file['name']);
            $target_file = $target_dir . $fileName;
    
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return $fileName;
            }
            return false;
        }
    }
}