<?php
include('../config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id =  $_POST["id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    try {
        $stmt = $conn->prepare("UPDATE products SET product_name=:product_name, price=:price, quantity=:quantity, description=:description WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
}

$conn = null
?>