<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $persen_diskon = $_POST['persen_diskon'];

    $query = "INSERT INTO kartu_diskon (nama, deskripsi, persen_diskon) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nama, $deskripsi, $persen_diskon]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Tambah Kartu Diskon</title>
    <link href="../../public/css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">

<?php include_once("../partials/navbar.php"); ?>

<div id="layoutSidenav">
    <?php include_once("../partials/sidebar.php"); ?>
    <div id="layoutSidenav_content">
        <main class="container-fluid px-4 mt-4">
            <h2>Tambah Kartu Diskon</h2>

            <form method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kartu Diskon</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="persen_diskon" class="form-label">Persen Diskon (%)</label>
                    <input type="number" class="form-control" id="persen_diskon" name="persen_diskon" required>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="index.php" class="btn btn-outline-secondary">Batal</a>
            </form>
        </main>
        <?php include_once("../partials/footer.php"); ?>
    </div>
</div>

<script src="../../public/js/scripts.js"></script>
</body>
</html>
