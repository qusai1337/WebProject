<?php
include 'dbconfig.in.php'; 

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM items WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: manage_inventory.php");
    } catch (PDOException $e) {
        die("Could not delete product: " . $e->getMessage());
    }
}
?>
