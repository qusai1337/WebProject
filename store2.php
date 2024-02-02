
<?php

session_start();
include 'logHeader.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$totalItemCount = array_sum($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <header>
        <nav>
            <ul>
                <li><a href="inter2.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li class="search-icon">
    <a href="#"><i class="fa fa-search"></i></a>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" id="searchForm">
    <select name="searchType" id="searchType">
        <option value="">Select Search Type...</option>
        <option value="price">Search by Price Range</option>
        <option value="name">Search by Name</option>
    </select>

    <div id="priceInputs" class="search-inputs">
        <input type="number" name="min_price" placeholder="Min Price">
        <input type="number" name="max_price" placeholder="Max Price">
    </div>

    <div id="nameInput" class="search-inputs">
        <input type="text" name="product_name" placeholder="Enter Product Name">
    </div>

    <button type="submit" class="search-btn">Search</button>
</form>

</li>
<li class="cart-icon">
            <a href="cart.php">
                <span>Cart</span>
                <img src="images/cart.png" alt="Cart" />
                <span id="cart-count"><?php echo $totalItemCount; ?></span>
            </a>
        </li>
            </ul>
        </nav>

    </header>
    <link rel="stylesheet" type="text/css" href="signup.css">


</head>

<body>
<?php

include 'dbconfig.in.php';
$displayResults = false;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';
        
        if ($searchType == 'price') {
            $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
            $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 99999999;
            $sql = "SELECT id, name, description, price, image_url FROM items WHERE price BETWEEN :min_price AND :max_price"; // Use the 'items' table
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':min_price', $min_price, PDO::PARAM_INT);
            $stmt->bindParam(':max_price', $max_price, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $displayResults = true; 
        } elseif ($searchType == 'name') {
            $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';
            $sql = "SELECT id, name, description, price, image_url FROM items WHERE name LIKE :name"; // Use the 'items' table
            $stmt = $pdo->prepare($sql);
            $name = '%' . $product_name . '%';
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $displayResults = true; 
        }
    }

    echo "<div class='container2'>";

    if ($displayResults) {
        if (!empty($results)) {
            foreach ($results as $row => $value) {
                echo "<div class='product'>";
                echo "<img src='images/" . htmlspecialchars($results[$row]["image_url"]) . "' alt='" . htmlspecialchars($results[$row]["name"]) . "' style='max-width:100%;height:auto;'>";
                echo "<h2>" . htmlspecialchars($results[$row]["name"]) . "</h2>";
                echo "<p>" . htmlspecialchars($results[$row]["description"]) . "</p>";
                echo "<p class='price'>$" . htmlspecialchars(number_format($results[$row]["price"], 2)) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No items found.</p>";
        }
    } else {

        $sql = "SELECT id, name, description, price, image_url FROM items"; // Use the 'items' table
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            foreach ($results as $row => $value) {
                echo "<div class='product'>";
                echo "<img src='images/" . htmlspecialchars($results[$row]["image_url"]) . "' alt='" . htmlspecialchars($results[$row]["name"]) . "' style='max-width:100%;height:auto;'>";
                echo "<h2>" . htmlspecialchars($results[$row]["name"]) . "</h2>";
                echo "<p>" . htmlspecialchars($results[$row]["description"]) . "</p>";
                echo "<p class='price'>$" . htmlspecialchars(number_format($results[$row]["price"], 2)) . "</p>";
                
                echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($results[$row]["id"]) . "'>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                
                echo "</div>";
            }
        } else {
            echo "<p>No items found.</p>";
        }
        
    }

    echo "</div>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>




    <meta charset="UTF-8">
    <title>Store Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container2 {
            width: 60%;
            padding-top: 15px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr); 
            gap: 5px;
        }

        .product {
            border: 1px solid #ddd;
            padding: 16px;
            text-align: center;
        }

        .product img {
            max-width: 60%;
            height: auto;
        }

        .product h2 {
            font-size: 1.5em;
            color: #333;
        }

        .product .price {
            color: #028f02;
            font-weight: bold;
        }
        .search-select, .search-inputs {
    margin-bottom: 10px;
}

.search-select select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.search-inputs input {
    width: calc(50% - 4px);
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.search-btn {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #028f02;
    color: white;
    font-size: 1em;
    cursor: pointer;
}

.search-btn:hover {
    background-color: #026f02;
}
    </style>
    </div>
    <?php include 'footer.html'; ?>

</body>

</html>