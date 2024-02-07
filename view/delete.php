<?php
include('../config/db.php');

$id = $_GET['id'];

try{
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = [];

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } 
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
}

$conn = null
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
    <?php if (count($row) > 0) : ?>
        <p>Are you sure you want to delete the following product?</p>
        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $row["id"]; ?></td>
            </tr>
            <tr>
                <td>Product Name:</td>
                <td><?php echo $row["product_name"]; ?></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><?php echo $row["price"]; ?></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td><?php echo $row["quantity"]; ?></td>
            </tr>
            <form action="../controller/delete.php" method="get">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="submit" value="Delete Product">
            </form>
        </table>
    <?php else : ?>
        <p>Data not found</p>
    <?php endif ?>
</body>
</html>