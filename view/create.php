<?php
include '../config/init.php';
include PROJECT_ROOT . '/controller/productController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productController = new ProductController();
    $data = array(
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description']
    );
    if ($productController->createProduct($data))  {
        $message = "Product added successfully.";
        header("Location: ../index.php?message=Product+created+successfully");
        exit();
    } else {
        echo "Failed to add product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h2>Create Product</h2>
    <?php if (!empty($message)) : ?> 
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="../index.php">Back to Product List</a>
    <br><br>

    <form action="create.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <br>
        <label for="quantity">Stok:</label>
        <input type="number" id="quantity" name="quantity" required>
        <br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        <br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>