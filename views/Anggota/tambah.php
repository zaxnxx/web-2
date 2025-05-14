<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

// Ambil data pegawai dan kartu diskon
$pegawai = $conn->query("SELECT * FROM pegawai WHERE id NOT IN (SELECT pegawai_id FROM anggota)")->fetchAll();
$diskon = $conn->query("SELECT * FROM kartu_diskon")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_aktif = isset($_POST['status_aktif']) ? 1 : 0;
    $pegawai_id = $_POST['pegawai_id'];
    $kartu_diskon_id = $_POST['kartu_diskon_id'] ?: null;

    $stmt = $conn->prepare("INSERT INTO anggota (status_aktif, pegawai_id, kartu_diskon_id) VALUES (?, ?, ?)");
    $stmt->execute([$status_aktif, $pegawai_id, $kartu_diskon_id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f6f9;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user-plus"></i> Tambah Anggota
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="pegawai_id" class="form-label">Pegawai</label>
                    <select name="pegawai_id" id="pegawai_id" class="form-select" required>
                        <option value="">-- Pilih Pegawai --</option>
                        <?php foreach ($pegawai as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?> (<?= $p['nip'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kartu_diskon_id" class="form-label">Kartu Diskon (opsional)</label>
                    <select name="kartu_diskon_id" id="kartu_diskon_id" class="form-select">
                        <option value="">-- Tanpa Diskon --</option>
                        <?php foreach ($diskon as $d): ?>
                            <option value="<?= $d['id'] ?>"><?= $d['nama'] ?> (<?= $d['persen_diskon'] ?>%)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="status_aktif" id="status_aktif" class="form-check-input" checked>
                    <label class="form-check-label" for="status_aktif">Aktifkan Anggota</label>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
