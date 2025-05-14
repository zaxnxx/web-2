<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

// Ambil data anggota dan nama pegawai
$query = "SELECT anggota.id, pegawai.nama 
          FROM anggota 
          JOIN pegawai ON anggota.pegawai_id = pegawai.id";
$stmt = $conn->query($query);
$anggota = $stmt->fetchAll();

// Ambil data kartu diskon
$query_kartu_diskon = "SELECT * FROM kartu_diskon";
$stmt_kartu_diskon = $conn->query($query_kartu_diskon);
$kartu_diskon = $stmt_kartu_diskon->fetchAll();

// Menampilkan pesan error atau sukses jika ada
$pesan_sukses = '';
$pesan_error = '';

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $anggota_id = $_POST['anggota_id'];
    $tanggal = $_POST['tanggal'];
    $kartu_diskon_id = $_POST['kartu_diskon_id'];
    $status_bayar = $_POST['status_bayar'];

    // Ambil persen diskon dari kartu_diskon
    $query_diskon = "SELECT persen_diskon FROM kartu_diskon WHERE id = ?";
    $stmt_diskon = $conn->prepare($query_diskon);
    $stmt_diskon->execute([$kartu_diskon_id]);
    $diskon_data = $stmt_diskon->fetch();
    $diskon = $diskon_data ? $diskon_data['persen_diskon'] : 0;

    // Insert pesanan
    $sql = "INSERT INTO pesanan (tanggal, diskon, status_bayar, anggota_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$tanggal, $diskon, $status_bayar, $anggota_id])) {
        header('Location: index.php');
        exit;
    } else {
        $pesan_error = "Terjadi kesalahan saat menambahkan pesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Tambah Pesanan</title>
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
                <h2 class="mb-4">Tambah Pesanan</h2>

                <?php if ($pesan_sukses): ?>
                    <div class="alert alert-success"><?= $pesan_sukses ?></div>
                <?php elseif ($pesan_error): ?>
                    <div class="alert alert-danger"><?= $pesan_error ?></div>
                <?php endif; ?>

                <form action="tambah.php" method="POST">
                    <div class="form-group">
                        <label for="anggota_id">Pilih Anggota</label>
                        <select name="anggota_id" id="anggota_id" class="form-control" required>
                            <option value="">Pilih Anggota</option>
                            <?php foreach ($anggota as $a): ?>
                                <option value="<?= $a['id'] ?>"><?= $a['nama'] ?> (ID: <?= $a['id'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="kartu_diskon_id">Pilih Kartu Diskon</label>
                        <select name="kartu_diskon_id" id="kartu_diskon_id" class="form-control" required>
                            <option value="">Pilih Kartu Diskon</option>
                            <?php foreach ($kartu_diskon as $kd): ?>
                                <option value="<?= $kd['id'] ?>"><?= $kd['nama'] ?> - <?= $kd['persen_diskon'] ?>%</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="status_bayar">Status Bayar</label>
                        <select name="status_bayar" id="status_bayar" class="form-control" required>
                            <option value="1">Sudah Bayar</option>
                            <option value="0">Belum Bayar</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </main>
            <?php include_once("../partials/footer.php"); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/js/scripts.js"></script>
</body>
</html>
