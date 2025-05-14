<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

// Ambil data anggota
$stmt = $conn->prepare("SELECT * FROM anggota WHERE id = ?");
$stmt->execute([$id]);
$anggota = $stmt->fetch();

if (!$anggota) {
    echo "Data anggota tidak ditemukan.";
    exit;
}

// Ambil data pegawai dan kartu diskon
$pegawai = $conn->query("SELECT * FROM pegawai")->fetchAll();
$diskon = $conn->query("SELECT * FROM kartu_diskon")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_aktif = isset($_POST['status_aktif']) ? 1 : 0;
    $pegawai_id = $_POST['pegawai_id'];
    $kartu_diskon_id = $_POST['kartu_diskon_id'] ?: null;

    try {
        $stmt = $conn->prepare("UPDATE anggota SET status_aktif = ?, pegawai_id = ?, kartu_diskon_id = ? WHERE id = ?");
        $stmt->execute([$status_aktif, $pegawai_id, $kartu_diskon_id, $id]);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Anggota</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="pegawai_id" class="form-label">Pegawai</label>
            <select name="pegawai_id" id="pegawai_id" class="form-select" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php foreach ($pegawai as $p): ?>
                    <option value="<?= htmlspecialchars($p['id']) ?>" <?= $p['id'] == $anggota['pegawai_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['nama']) ?> (<?= htmlspecialchars($p['nip']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kartu_diskon_id" class="form-label">Kartu Diskon (opsional)</label>
            <select name="kartu_diskon_id" id="kartu_diskon_id" class="form-select">
                <option value="">-- Tanpa Diskon --</option>
                <?php foreach ($diskon as $d): ?>
                    <option value="<?= htmlspecialchars($d['id']) ?>" <?= $d['id'] == $anggota['kartu_diskon_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['nama']) ?> (<?= htmlspecialchars($d['persen_diskon']) ?>%)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="status_aktif" id="status_aktif" class="form-check-input"
                <?= $anggota['status_aktif'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="status_aktif">Aktifkan Anggota</label>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
