<?php
include('../config/init.php');
include PROJECT_ROOT . '/controller/productController.php';

$productController = new ProductController();

$id = $_GET['id'];

// validasi ID
if (empty($id)) {
    header("Location: ../index.php?message=Product+ID+not+provided.");
    exit;
} elseif (!is_numeric($id) || $id <= 0) {
    header("Location: ../index.php?message=Invalid+Product+ID.");
    exit;
}

// sebelum di delete cek apakah product dengan id tsb ada atau tidak
$product = $productController->getProductById($id, TABLE_NAME);
if (!$product) {
    header("Location: ../index.php?message=Product+not+found.");
    exit;
} else {
    if ($productController->deleteMultipleProducts([$id], TABLE_NAME, 'is_deleted')) {
        header("Location: ../index.php?message=Product+succesfully+deleted.");
        exit;
    }
}
?>