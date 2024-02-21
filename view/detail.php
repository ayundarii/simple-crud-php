<?php
include '../config/init.php';
include PROJECT_ROOT . '/controller/productController.php';

$id = $_GET['id'];

$productController = new ProductController();

if (empty($id)) {
    header("Location: ../index.php?message=Product+ID+not+provided.");
    exit;
} elseif (!is_numeric($id) || $id <= 0) {
    header("Location: ../index.php?message=Invalid+Product+ID.");
    exit;
} 

$product = $productController->getProductById($id, TABLE_NAME);
if (!$product) {
    header("Location: ../index.php?message=Product+not+found.");
    exit;
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <h2>Product Details</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $product["id"]; ?></td>
            </tr>
            <tr>
                <td>Product Name:</td>
                <td><?php echo $product["product_name"]; ?></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><?php echo $product["price"]; ?></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td><?php echo $product["quantity"]; ?></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><?php echo $product["description"]; ?></td>
            </tr>
        </table>
</body>
</html>