<?php
include('../config/init.php');
include PROJECT_ROOT . '/controller/productController.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $productController = new ProductController();
    $product = $productController->getProductById($id, TABLE_NAME);

    if($product) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];

            // validasi product name
            if (empty($_POST["product_name"])) {
                $errors[] = "Product name is required.";
            }

            // validasi price
            if (empty($_POST["price"])) {
                $errors[] = "Price is required.";
            } elseif (!is_numeric($_POST["price"]) || $_POST["price"] <= 0) {
                $errors[] = "Price must be a positive number.";
            }

            // validasi quantity
            if (!is_numeric($_POST["quantity"]) || $_POST["quantity"] < 0) {
                $errors[] = "Quantity must be a non-negative number.";
            } 

            // validasi deskripsi
            if (empty($_POST["description"])) {
                $errors[] = "Description is required.";
            } elseif (!empty($_POST["description"]) && strlen($_POST["description"]) > 255) {
                $errors[] = "Description must be less than 255 characters.";
            }

            if (empty($errors)) {
                $data = array(
                    'product_name' => $_POST['product_name'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['quantity'],
                    'description' => $_POST['description']
                );
                
                if($productController->updateProduct($id, $data, TABLE_NAME)){
                    header('Location: ../index.php?message=Product+updated+successfully');
                    exit;
                } else {
                    $message = "Failed to update product.";
                }
            }
        }
    } else {
        $errors[] = "Product not found."; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
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
        <?php if($product) : ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>
            <br>
            <label for="price">Price:</label>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
            <br>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>
            <br>
            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo $product['description']; ?>" required>
            <br>
            <input type="submit" value="Update Product">
        </form>
        <?php endif; ?>
</body>
</html>