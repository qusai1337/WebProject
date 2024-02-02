<?php
include 'dbconfig.in.php'; 
session_start();

if (isset($_POST['update_status']) && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $currentDateTime = date('Y-m-d H:i:s'); 
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE orders SET status = 'Shipped', shipped_date = :shippedDate WHERE order_id = :orderId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':orderId' => $orderId, ':shippedDate' => $currentDateTime]);

        header("Location: emp_dashboard.php"); 
        exit;
    } catch (PDOException $e) {
        die("Error updating order status: " . $e->getMessage());
    }
}
$sqlHistory = "INSERT INTO order_status_history (order_id, status, changed_on) VALUES (:orderId, 'Shipped', :changedOn)";
$stmtHistory = $pdo->prepare($sqlHistory);
$stmtHistory->execute([':orderId' => $orderId, ':changedOn' => $currentDateTime]);

?>
