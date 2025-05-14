<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

// Ambil data pesanan
$stmt = $conn->prepare("SELECT * FROM pesanan WHERE id = ?");
$stmt->execute([$id]);
$pesanan = $stmt->fetch();

if (!$pesanan) {
    echo "Pesanan tidak ditemukan.";
    exit;
}

// Ambil data produk dan detail pesanan
$produk = $conn->query("SELECT * FROM produk")->fetchAll();
$detail_pesanan = $conn->prepare("SELECT * FROM detail_pesanan WHERE pesanan_id = ?");
$detail_pesanan->execute([$id]);
$detail = $detail_pesanan->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $diskon = $_POST['diskon'];
    $anggota_id = $_POST['anggota_id'];

    // Update Pesanan
    $stmt = $conn->prepare("UPDATE pesanan SET tanggal = ?, diskon = ?, anggota_id = ? WHERE id = ?");
    $stmt->execute([$tanggal, $diskon, $anggota_id, $id]);

    // Hapus detail pesanan lama
    $conn->prepare("DELETE FROM detail_pesanan WHERE pesanan_id = ?")->execute([$id]);

    // Tambah detail pesanan baru
    foreach ($_POST['produk'] as $produk_id => $jumlah) {
        if ($jumlah > 0) {
            $stmt_detail = $conn->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) VALUES (?, ?, ?)");
            $stmt_detail->execute([$id, $produk_id, $jumlah]);
        }
    }

    // Redirect setelah berhasil
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">

<?php include_once("../partials/navbar.php"); ?>

<div id="layoutSidenav">
    <?php include_once("../partials/sidebar.php"); ?>
    <div id="layoutSidenav_content">
        <main class="container-fluid px-4 mt-4">
            <h2>Edit Pesanan</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="anggota_id" class="form-label">Anggota</label>
                    <select name="anggota_id" id="anggota_id" class="form-select" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php 
                        $anggota = $conn->query("SELECT * FROM anggota")->fetchAll();
                        foreach ($anggota as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= $a['id'] == $pesanan['anggota_id'] ? 'selected' : '' ?>>
                                <?= $a['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Pesanan</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= $pesanan['tanggal'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="diskon" class="form-label">Diskon (%)</label>
                    <input type="number" id="diskon" name="diskon" class="form-control" min="0" max="100" value="<?= $pesanan['diskon'] ?>" required>
                </div>

                <h4>Pilih Produk</h4>
                <?php foreach ($produk as $p): ?>
                    <div class="mb-3">
                        <label class="form-label"><?= $p['nama'] ?> (<?= $p['harga'] ?>)</label>
                        <input type="number" name="produk[<?= $p['id'] ?>]" class="form-control" min="0" 
                               value="<?= isset($detail[$p['id']]) ? $detail[$p['id']]['jumlah'] : 0 ?>" placeholder="Jumlah">
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </main>
    </div>
</div>

<?php include_once("../partials/footer.php"); ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../public/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="../../public/js/datatables-simple-demo.js"></script>
</body>
</html>
