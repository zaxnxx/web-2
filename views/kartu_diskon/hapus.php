<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM kartu_diskon WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
