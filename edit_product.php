<?php
include 'dbconfig.in.php'; 

$productName = $productDescription = $productPrice = $productQuantity = "";
$productId = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];

    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE items SET name = ?, description = ?, price = ?, quantity = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$productName, $productDescription, $productPrice, $productQuantity, $productId]);

        header("Location: manage_inventory.php");
        exit();
    } catch (PDOException $e) {
        die("Error updating product: " . $e->getMessage());
    }
} else {
    if (!empty($productId)) {
        try {
            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM products WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$productId]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $productName = $product['name'];
                $productDescription = $product['description'];
                $productPrice = $product['price'];
                $productQuantity = $product['quantity'];
            } else {
                echo "<p>Product not found.</p>";
            }
        } catch (PDOException $e) {
            die("Error fetching product: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="table.css">

    <title>Edit Product</title>
  
</head>
<body>

<h2>Edit Product</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($productId); ?>">
    <div>
        <label for="productName">Name:</label>
        <input type="text" name="productName" id="productName" value="<?php echo htmlspecialchars($productName); ?>" required>
    </div>
    <div>
        <label for="productDescription">Description:</label>
        <textarea name="productDescription" id="productDescription" required><?php echo htmlspecialchars($productDescription); ?></textarea>
    </div>
    <div>
        <label for="productPrice">Price:</label>
        <input type="text" name="productPrice" id="productPrice" value="<?php echo htmlspecialchars($productPrice); ?>" required>
    </div>
    <div>
        <label for="productQuantity">Quantity:</label>
        <input type="number" name="productQuantity" id="productQuantity" value="<?php echo htmlspecialchars($productQuantity); ?>" required>
    </div>
    <button type="submit">Update Product</button>
</form>

</body>
</html>
