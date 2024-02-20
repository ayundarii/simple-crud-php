<?php
include('../config/init.php');
include PROJECT_ROOT . '/controller/productController.php';

$productController = new ProductController();

$id = $_GET['id'];

$product = $productController->getProductById($id);
if($productController->deleteProduct($id)){
    header("Location: ../index.php?message=Product+succesfully+deleted.");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
    <h2>Delete Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
        <p>Are you sure you want to delete the following product?</p>
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
            <form action="delete.php" method="get">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="submit" value="Delete Product">
            </form>
        </table>
</body>
</html>