<?php
session_start(); 
include 'dbconfig.in.php';


if (empty($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
    echo "<a href='store2.php'>Return to store</a>";
    exit;
}

function getProductDetails($pdo, $productId) {
    $stmt = $pdo->prepare("SELECT id, name, description, price, image_url FROM items WHERE id = :id");
    $stmt->execute([':id' => $productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .cart-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: auto;
        }
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .cart-item img {
            margin-right: 20px;
        }
        .cart-item p {
            margin: 5px 10px;
        }
        a, input[type="submit"] {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        a:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }
        .total-price {
            text-align: right;
            font-size: 20px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <div class="cart-container">
        <?php
        $totalPrice = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $product = getProductDetails($pdo, $productId);
                if ($product) {
                    echo "<div class='cart-item'>";
                    echo "<img src='images/" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['name']) . "' style='width:100px; height:auto;'>";
                    echo "<p>Name: " . htmlspecialchars($product['name']) . "</p>";
                    echo "<p>Description: " . htmlspecialchars($product['description']) . "</p>";
                    echo "<p>Price: $" . htmlspecialchars($product['price']) . "</p>";
                    echo "<p>Quantity: " . htmlspecialchars($quantity) . "</p>";
                    echo "</div>";
                    $totalPrice += $product['price'] * $quantity;
                }
            }
            echo "<p class='total-price'>Total Price: $" . htmlspecialchars($totalPrice) . "</p>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="store2.php">Continue Shopping</a>
        <?php if (!empty($_SESSION['cart'])): ?>
            <form action="submit_order.php" method="post" style="display: inline-block;">
                <input type="submit" value="Submit Order">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
