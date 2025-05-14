<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis_produk_id = $_POST['jenis_produk_id'];

    $query = "INSERT INTO produk (kode, nama, deskripsi, harga, stok, jenis_produk_id) 
              VALUES (:kode, :nama, :deskripsi, :harga, :stok, :jenis_produk_id)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':kode', $kode);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':deskripsi', $deskripsi);
    $stmt->bindParam(':harga', $harga);
    $stmt->bindParam(':stok', $stok);
    $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM jenis_produk";
$stmt = $conn->query($query);
$jenis_produk_list = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tambah Produk</title>
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    
    <?php include_once("../partials/navbar.php"); ?>

    <div id="layoutSidenav">
        <?php include_once("../partials/sidebar.php"); ?>
        
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4 mt-4">
                <h2>Tambah Produk</h2>

                <div class="mb-3">
                    <a href="index.php" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
                    </a>
                </div>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Produk</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                        <select class="form-control" id="jenis_produk_id" name="jenis_produk_id" required>
                            <?php foreach ($jenis_produk_list as $jp): ?>
                                <option value="<?= $jp['id'] ?>"><?= $jp['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </main>

            <?php include_once("../partials/footer.php"); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
