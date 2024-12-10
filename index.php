<?php

session_start();
require_once 'Config/db_con.php';
require_once 'Controllers/usercontroller.php';
require_once 'Controllers/PhoneController.php';
require_once 'Models/User.php';
require_once 'Models/Phone.php';

$userController = new usercontroller();
$phoneController = new PhoneController();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if (!isset($_SESSION['username'])) {
    if ($action === 'register') {
        $userController->register();
    } else {
        $userController->login();
    }
} else {
    switch ($action) {
        case 'logout':
            $userController->logout();
            break;
        case 'tambah_barang':
            $phoneController->addPhone();
            break;
        case 'update':
            $phoneController->updatePhone();
            break;
        case 'delete':
            $phoneController->delete($_GET['id']);
            break;
        case 'deskripsi':
            $phoneController->deskripsiPhone();
            break;
        default:
            $phoneController->index();
            break;
    }
}