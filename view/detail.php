<?php
include '../config/init.php';
include PROJECT_ROOT . '/controller/productController.php';

$id = $_GET['id'];

$productController = new ProductController();

if($id !== null) {
    $product = $productController->getProductById($id);
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