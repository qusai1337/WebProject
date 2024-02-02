<?php
include 'dbconfig.in.php';

try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM orders ORDER BY order_history DESC";
    $stmt = $pdo->query($sql);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
function getProductDetails($pdo, $productId) {
    $stmt = $pdo->prepare("SELECT name, price, description FROM products WHERE id = :productId");
    $stmt->execute([':productId' => $productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$orders = $pdo->query("SELECT * FROM orders ORDER BY order_history DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="table.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Control Page</title>
    
</head>
<body>
<div class="sidebar">
    <a href="?section=process-orders">Process Orders</a>
    <a href="?section=view-orders">View Orders</a>
    <a href="manage_inventory.php">Manage Inventory</a>
    <a href="emp_signin.php">Back to home</a>
</div>
    <div class="container">
        
        <h1>Welcome, Employee Name</h1>
        <section id="process-orders">
    <h2>Process Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Current Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td>
                        <?php if ($order['status'] == 'Pending'): ?>
                            <form action="update_order_status.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                <input type="submit" name="update_status" value="Mark as Shipped" class="button">
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

        <section id="view-orders">
        <section id="view-orders">
    <h2>View Orders</h2>
    <?php if (!empty($orders)): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_history']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td>
                            <ul>
                                <?php
                                $details = unserialize($order['order_details']);
                                foreach ($details as $productId => $quantity) {
                                    $product = getProductDetails($pdo, $productId);
                                    if ($product) {
                                        echo "<li>" . htmlspecialchars($product['name']) . " - Quantity: $quantity - $" . htmlspecialchars($product['price']) . "</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</section>


        <section id="manage-inventory">
        <a href="manage_inventory.php">manage inventory </a>
        </section>
    </div>
</body>
</html>
