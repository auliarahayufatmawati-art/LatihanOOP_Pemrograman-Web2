<?php
require "Database.php";
$conn = Database::getInstance()->getConnection();

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM prodi WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: prodi_index.php");
exit;
?>