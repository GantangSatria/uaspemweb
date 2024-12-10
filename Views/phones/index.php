<?php
// session_start();

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
    <title>Stock HP</title>
    <link rel="stylesheet" href="Assets/styles.css">
    <style>
        body {
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            margin-top: 0px;
            margin-bottom: 20px;
        }
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Stock HP</h2>
        <a href="index.php?action=tambah_barang" class="btn">Tambah Barang</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($phones): ?>
                <?php foreach ($phones as $phone): ?>
                    <tr>
                        <td><?= htmlspecialchars($phone['phone_id']); ?></td>
                        <td><?= htmlspecialchars($phone['brand']); ?></td>
                        <td><?= htmlspecialchars($phone['name']); ?></td>
                        <td>
                            <?php if (!empty($phone['image_path'])): ?>
                                <img src="Assets/<?php echo htmlspecialchars( $phone['image_path']); ?>" class="img-thumbnail" alt="Image of <?= htmlspecialchars($phone['name']); ?>">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?action=deskripsi&phone_id=<?= htmlspecialchars($phone['phone_id']); ?>" class="btn-warning">Lihat Detail</a>
                            <a href="index.php?action=update&phone_id=<?= htmlspecialchars($phone['phone_id']); ?>" class="btn-warning">Update</a>
                            <a href="index.php?action=delete&phone_id=<?= htmlspecialchars($phone['phone_id']); ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data handphone yang tersedia.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php?action=logout" class="btn">Logout</a>
    </div>
</body>
</html>
