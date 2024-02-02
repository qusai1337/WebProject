<?php
session_start();
include 'dbconfig.in.php'; 

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

$orderDetails = serialize($_SESSION['cart']); 
$status = "Pending"; 

try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS); 
    $sql = "INSERT INTO orders (order_details, status) VALUES (:orderDetails, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':orderDetails' => $orderDetails, ':status' => $status]);

    echo "Order submitted successfully!";
    unset($_SESSION['cart']); 
} catch (PDOException $e) {
    echo "Error submitting order: " . $e->getMessage();
}
?>
