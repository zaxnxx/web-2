<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$query = "SELECT * FROM pegawai";
$stmt = $conn->query($query);
$pegawai = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Pegawai</title>
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
                <h2 class="mb-4">Data Pegawai</h2>

                <!-- Tombol Kembali ke Dashboard -->
                <div class="mb-3">
                    <a href="../../index.php" class="btn btn-outline-dark d-inline-flex align-items-center gap-2">
                        <i class="fas fa-home"></i> Kembali ke Dashboard
                    </a>
                </div>

                <div class="text-end mb-3">
                    <a href="tambah.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah Pegawai
                    </a>
                </div>

                <table class="table table-bordered" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pegawai as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= $p['nip'] ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td><?= $p['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                            <td><?= $p['jabatan'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
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
