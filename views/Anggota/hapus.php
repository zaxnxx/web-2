<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Mulai transaksi untuk menjaga integritas data
        $conn->beginTransaction();

        // Ambil semua pesanan yang terkait dengan anggota ini
        $stmt = $conn->prepare("SELECT id FROM pesanan WHERE anggota_id = ?");
        $stmt->execute([$id]);
        $pesananList = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Hapus detail_pesanan dan pembayaran yang terkait dengan setiap pesanan
        foreach ($pesananList as $pesanan_id) {
            // Hapus detail pesanan
            $stmtDetail = $conn->prepare("DELETE FROM detail_pesanan WHERE pesanan_id = ?");
            $stmtDetail->execute([$pesanan_id]);

            // Hapus pembayaran
            $stmtBayar = $conn->prepare("DELETE FROM pembayaran WHERE pesanan_id = ?");
            $stmtBayar->execute([$pesanan_id]);
        }

        // Hapus semua pesanan anggota ini
        $stmtPesanan = $conn->prepare("DELETE FROM pesanan WHERE anggota_id = ?");
        $stmtPesanan->execute([$id]);

        // Terakhir, hapus anggota
        $stmtAnggota = $conn->prepare("DELETE FROM anggota WHERE id = ?");
        $stmtAnggota->execute([$id]);

        // Commit transaksi jika semua berhasil
        $conn->commit();
    } catch (PDOException $e) {
        // Rollback jika ada kesalahan
        $conn->rollBack();
        die("Gagal menghapus data: " . $e->getMessage());
    }
}

// Redirect ke index
header('Location: index.php');
exit;
