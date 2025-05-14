<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$query = "SELECT pesanan.*, anggota.id AS anggota_id, pegawai.nama AS nama_pegawai
          FROM pesanan
          JOIN anggota ON pesanan.anggota_id = anggota.id
          JOIN pegawai ON anggota.pegawai_id = pegawai.id";
$stmt = $conn->query($query);
$pesanan = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Data Pesanan</title>
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
            <h2>Data Pesanan</h2>

            <div class="mb-3">
                <a href="../../index.php" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <a href="tambah.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pesanan
                </a>
            </div>

            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Diskon</th>
                        <th>Status Bayar</th>
                        <th>Nama Pegawai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['tanggal'] ?></td>
                        <td><?= $p['diskon'] ?>%</td>
                        <td><?= $p['status_bayar'] ? 'Lunas' : 'Belum' ?></td>
                        <td><?= $p['nama_pegawai'] ?></td>
                        <td class="d-flex gap-1">
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>
                            <a href="../pembayaran/index.php?pesanan_id=<?= $p['id'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-receipt"></i> Pembayaran
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>

        <?php include_once("../partials/footer.php"); ?>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../public/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="../../public/js/datatables-simple-demo.js"></script>
</body>
</html>
