<?php
include '../config/init.php';
include PROJECT_ROOT . '/controller/productController.php';

$controller = new ProductController();
$products = $controller->getDeletedProducts(TABLE_NAME);
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_products'])){
    $productController = new ProductController();
    $listId = $_POST['selected_products'];
    if ($productController->restoreData($listId, TABLE_NAME)) {
        header("Location: ../index.php?message=Succesfully+restored+products.");
        exit;
    } else {
        $message = "Failed to recover products.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['selected_products'])) {
    $message = "No products selected for recovery."; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Product List</title>
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
    <h2>Deleted Product List</h2>
    <?php if (!empty($message)) : ?> 
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="../index.php">Back to Homepage</a>
    <br><br>
    <form action="" method="post">
    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Select</th>
        </tr>

        <?php if (count($products) > 0) : ?>
        <?php $counter = 1 ?>
        <?php foreach($products as $product) : ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $product["product_name"] ?></td>
                <td><?php echo $product["price"]?></td>
                <td><?php echo $product["quantity"]?></td>
                <td><?php echo $product["description"]?></td>
                <td>
                    <input type="checkbox" name="selected_products[]" value="<?php echo $product['id'] ?>">
                </td>
            </tr>
            <?php $counter++ ?>
        <?php endforeach ?>
        <tr>
            <td colspan="7">
                <button type="submit" class="restore-button">Restore Selected Products</button>
            </td>
        </tr>
        <?php else : ?>
            <tr>
                <td colspan="6">0 results</td>
            </tr>
        <?php endif ?>
    </table>
    </form>
</body>
</html>