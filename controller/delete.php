<?php
include('../config/db.php');

$id = $_GET['id'];

try{
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: ../index.php');
    exit();
} catch (PDOException $e) {
    echo "Error deleting record: ".$e->getMessage();
}

$conn = null
?>