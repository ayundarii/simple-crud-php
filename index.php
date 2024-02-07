<?php
include('config/db.php');
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];

if($result->rowCount()>0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $products[] = $row;
    }
}

$conn = null
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
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>

        <?php if (count($products) > 0) : ?>
        <?php $counter = 1 ?>
        <?php foreach($products as $product) : ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $product["product_name"] ?></td>
                <td><?php echo $product["price"]?></td>
                <td><?php echo $product["quantity"]?></td>
                <td>
                    <a href="view/detail.php?id=<?php echo $product["id"] ?>">View</a>
                    <a href="view/update.php?id=<?php echo $product["id"] ?>">Update</a>
                    <a href="view/delete.php?id=<?php echo $product["id"] ?>">Delete</a>
                </td>
            </tr>
            <?php $counter++ ?>
        <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td colspan="5">0 results</td>
            </tr>
        <?php endif ?>
    </table>
</body>
</html>