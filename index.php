<?php
include 'config/init.php';
include PROJECT_ROOT . '/controller/productController.php';

$controller = new ProductController();
$products = $controller->getProducts();
$message = "";

$totalPrice = 0;

foreach ($products as $product) {
  $totalPrice += $product['price'] * $product['quantity'];
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_products'])){
    $productController = new ProductController();
    $listId = $_POST['selected_products'];
    if ($productController->deleteMultipleProducts($listId)) {
        header("Location: index.php?message=Succesfully+deleted+products.");
        exit;
    } else {
        $message = "Failed to delete products.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['selected_products'])) {
    $message = "No products selected for delete."; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Product List</h2>
    <a href="view/create.php">Add Product</a>
    <a href="view/deletedData.php">Recover Deleted Products</a>
    <?php if (!empty($message)) : ?> 
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['message'])) : ?> 
        <p><?php echo '<script>alert("'. htmlspecialchars($_GET['message']).'")</script>'; ; ?></p>
    <?php endif; ?>
    <br><br>
    <form action="" method="post">
    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Description</th>
            <th>Action</th>
            <th>Delete Selection</th>
        </tr>   
        <?php if (count($products) > 0) : ?>
        <?php $counter = 1 ?>
        <?php foreach($products as $product) : ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $product["product_name"] ?></td>
                <td>$<?php echo $product["price"]?></td>
                <td><?php echo $product["quantity"]?></td>
                <td>$<?php echo $product['price'] * $product['quantity']?></td>
                <td><?php echo $product["description"]?></td>
                <td>
                    <a href="view/detail.php?id=<?php echo $product["id"] ?>">View</a>
                    <a href="view/update.php?id=<?php echo $product["id"] ?>">Update</a>
                    <a href="view/delete.php?id=<?php echo $product["id"] ?>">Delete</a>
                </td>
                <td>
                    <input type="checkbox" name="selected_products[]" value="<?php echo $product['id'] ?>">
                </td>
            </tr>
            <?php $counter++ ?>
        <?php endforeach ?>
        <tr>
            <th colspan="4">Total Price</th>
            <td colspan="1">
                $<?php echo $totalPrice; ?>
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <button type="submit" class="delete-multiple-button">Delete Selected Products</button>
            </td>
        </tr>
        <?php else : ?>
            <tr>
                <td colspan="8">0 results</td>
            </tr>
        <?php endif ?>
    </table>
    </form>
</body>
</html>