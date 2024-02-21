<?php
include('../config/init.php');
include PROJECT_ROOT . '/controller/productController.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $productController = new ProductController();

    $product = $productController->getProductById($id, TABLE_NAME);

    if($product) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    } else {
        $message = "Product not found."; 
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
    <?php if (!empty($message)) : ?> 
        <p><?php echo $message; ?></p>
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