<?php
// session_start();
// require 'config/db_con.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="Assets/styles.css">
    <style>
        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Barang</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="brand">Merk:</label>
            <input type="text" id="brand" name="brand" required>

            <label for="name">Tipe:</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Harga:</label>
            <input type="number" id="price" name="price" required step="0.01" min="0">

            <label for="release_year">Tahun Rilis:</label>
            <input type="number" id="release_year" name="release_year" required>

            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Gambar:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <br>
            <button type="submit" class="btn">Tambah Barang</button>
        </form>
        <a href="index.php" class="btn">Kembali</a>
    </div>
</body>
</html>
