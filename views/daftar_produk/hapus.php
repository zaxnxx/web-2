<?php
require_once '../../config/Connection.php';
$conn = Connection::getConnection();

$id = $_GET['id'];

$query = "DELETE FROM produk WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: index.php");
exit();
?>
