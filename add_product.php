<?php
include 'dbconfig.in.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $imageUrl = $_POST['image_url'] ?? ''; 
    $remarks = $_POST['remarks'] ?? '';
    $size = $_POST['size'] ?? '';
    
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO items (name, description, price, quantity, category, image_url, remarks, size) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$productName, $productDescription, $productPrice, $productQuantity, $category, $imageUrl, $remarks, $size])) {
            echo "Product added successfully.";
        } else {
            echo "Error adding product.";
        }
    } catch(PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }

    unset($pdo);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="table.css">

    <title>Add Product</title>
   
</head>
<body>
    <h2>Add New Product</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="productName">Name:</label>
            <input type="text" name="productName" id="productName" required>
        </div>
        <div>
            <label for="productDescription">Description:</label>
            <textarea name="productDescription" id="productDescription" required></textarea>
        </div>
        <div>
            <label for="productPrice">Price ($):</label>
            <input type="number" step="0.01" name="productPrice" id="productPrice" required>
        </div>
        <div>
            <label for="productQuantity">Quantity:</label>
            <input type="number" name="productQuantity" id="productQuantity" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" required>
        </div>
        <div>
            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url" id="image_url" required>
        </div>
        <div>
            <label for="remarks">Remarks:</label>
            <textarea name="remarks" id="remarks" required></textarea>
        </div>
        <div>
            <label for="size">Size:</label>
            <input type="text" name="size" id="size" required>
        </div>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
