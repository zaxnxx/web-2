<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$filter = '';
if (isset($_GET['pesanan_id'])) {
    $filter = 'WHERE pesanan.id = ' . intval($_GET['pesanan_id']);
}

$query = "
SELECT 
    pesanan.id,
    pesanan.tanggal,
    pesanan.status_bayar,
    pegawai.nama AS nama_pegawai
FROM pesanan
JOIN anggota ON pesanan.anggota_id = anggota.id
JOIN pegawai ON anggota.pegawai_id = pegawai.id
$filter
ORDER BY pesanan.tanggal DESC
";
$stmt = $conn->query($query);
$pembayaran = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Pembayaran</title>
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
            <h2>Status Pembayaran</h2>

            <div class="mb-3 d-flex gap-2">
                <a href="../../index.php" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
                <a href="../pemesanan/index.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Data Pesanan
                </a>
            </div>

            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Status Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaran as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nama_pegawai']) ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['status_bayar'] ? 'Lunas' : 'Belum' ?></td>
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
