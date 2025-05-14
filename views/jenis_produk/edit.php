<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    $query = "UPDATE jenis_produk SET nama = :nama, deskripsi = :deskripsi WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':deskripsi', $deskripsi);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM jenis_produk WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$jenis_produk = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Jenis Produk</title>
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    
    <?php include_once("../partials/navbar.php"); ?>

    <div id="layoutSidenav">
        <?php include_once("../partials/sidebar.php"); ?>
        
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4 mt-4">
                <h2>Edit Jenis Produk</h2>

                <div class="mb-3">
                    <a href="index.php" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>

                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $jenis_produk['id'] ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jenis Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $jenis_produk['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $jenis_produk['deskripsi'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </main>

            <?php include_once("../partials/footer.php"); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
