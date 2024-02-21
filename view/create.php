<?php
include '../config/init.php';
include PROJECT_ROOT . '/controller/productController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productController = new ProductController();
    $errors = [];

    // Validate product name
    if (empty($_POST["product_name"])) {
        $errors[] = "Product name is required.";
    }

    // Validate price
    if (empty($_POST["price"])) {
        $errors[] = "Price is required.";
    } elseif (!is_numeric($_POST["price"]) || $_POST["price"] <= 0) {
        $errors[] = "Price must be a positive number.";
    }

    // Validate quantity
    if (empty($_POST["quantity"])) {
        $errors[] = "Quantity is required.";
    } elseif (!is_numeric($_POST["quantity"]) || $_POST["quantity"] < 0) {
        $errors[] = "Quantity must be a non-negative number.";
    }

    // Validate description (description can be empty)
    if (!empty($_POST["description"]) && strlen($_POST["description"]) > 255) {
        $errors[] = "Description must be less than 255 characters.";
    }

    if (empty($errors)) {
        // All validations passed
        $data = array(
            'product_name' => $_POST['product_name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
            'description' => $_POST['description']
        );

        if ($productController->createProduct($data, TABLE_NAME)) {
            header("Location: ../index.php?message=Product+created+successfully");
            exit();
        } else {
            $errors[] = "Failed to add product.";
        }
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
    <?php if (!empty($errors)) : ?>
        <ul>
            <h4>Please pay attention to these criterias:</h4>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="../index.php">Back to Product List</a>
    <br><br>

    <form action="create.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name">
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price">
        <br>
        <label for="quantity">Stok:</label>
        <input type="number" id="quantity" name="quantity">
        <br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description">
        <br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>