<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$query = "SELECT anggota.*, pegawai.nama AS nama_pegawai FROM anggota 
            JOIN pegawai ON anggota.pegawai_id = pegawai.id";
$stmt = $conn->query($query);
$anggota = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .btn-outline-dark:hover {
            background-color: #343a40;
            color: #fff;
            border-color: #343a40;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    
    <?php include_once("../partials/navbar.php"); ?>

    <div id="layoutSidenav">
        <?php include_once("../partials/sidebar.php"); ?>
        
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4 mt-4">
                <h2>Data Anggota</h2>

                <!-- Tombol Kembali ke Index Utama -->
                <div class="mb-3">
                    <a href="../../index.php" class="btn btn-outline-dark d-inline-flex align-items-center gap-2" style="transition: all 0.2s ease;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>

                <!-- Tombol Tambah Anggota di sebelah kanan -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="tambah.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah Anggota
                    </a>
                </div>

                <table class="table table-bordered" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pegawai</th>
                            <th>Status Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota as $a): ?>
                        <tr>
                            <td><?= $a['id'] ?></td>
                            <td><?= $a['nama_pegawai'] ?></td>
                            <td><?= $a['status_aktif'] ? 'Aktif' : 'Tidak Aktif' ?></td>
                            <td>
                                <a href="edit.php?id=<?= $a['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $a['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
