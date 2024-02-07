<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h2>Create Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>

    <form action="../controller/create.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <br>
        <label for="quantity">Stok:</label>
        <input type="number" id="quantity" name="quantity" required>
        <br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>