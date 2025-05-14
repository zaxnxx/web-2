<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

// Hapus detail pesanan terlebih dahulu
$stmt_detail = $conn->prepare("DELETE FROM detail_pesanan WHERE pesanan_id = ?");
$stmt_detail->execute([$id]);

// Hapus pesanan
$stmt_pesanan = $conn->prepare("DELETE FROM pesanan WHERE id = ?");
$stmt_pesanan->execute([$id]);

// Redirect setelah berhasil
header("Location: index.php");
exit;
?>
