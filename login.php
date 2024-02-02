
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "dbconfig.in.php"; 
session_start();

try {
  $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['passwordd'])) {
      $username = $_POST['username'];
      $passwordd = $_POST['passwordd'];

      $table = (strpos($username, 'emp_') === 0) ? 'employees' : 'customers';
      $passwordd_field = ($table === 'employees') ? 'passwordd' : 'passwordd';

      $sql = $pdo->prepare("SELECT * FROM $table WHERE username = :username");

      $sql->bindValue(':username', $username);
      $sql->execute();
      $result = $sql->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        if ($passwordd === $result[$passwordd_field]) {
          $_SESSION['username'] = $username;
          $_SESSION['user_name'] = $result['username']; 

          $redirectPage = (strpos($username, 'emp_') === 0) ? 'emp_signin.php' : 'inter2.php';
          echo "Redirect Page: " . $redirectPage . "<br>";
          header('Location: ' . $redirectPage);
          exit;
        } else {
          echo "Invalid password";
        }
      } else {
        echo "Invalid username";
      }

      echo "<pre>";
      var_dump($result);
      echo "</pre>";
    }
  }
} catch (PDOException $e) {
  echo "Database error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SignIn</title>
  <link rel="stylesheet" type="text/css" href="signup.css" />

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

</head>

<body>

  <div class="header-container1">

  <header>
  <nav>
    <ul>
      <li><a href="inter.php">Home</a></li>
      <li><a href="store.php">Store</a></li>
      <li><a href="about.php">About</a></li>
      <?php if (isset($_SESSION['username'])): ?>
        <li>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></li>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
    <div class="container">

      <div class="container">
        <div class="forms-container">
          <div class="signin">
            <form action="login.php" method="POST" class="sign-in-form">
              <h2 class="title">Sign In</h2>
              <div class="input">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" />
              </div>
              <div class="input">
                <i class="fas fa-lock"></i>
                <input type="password" name="passwordd" placeholder="Password" />
              </div>
              <input type="submit" value="LOGIN" class="btn solid" />
            </form>
          </div>
        </div>
      </div>
      <div class="panel left-panel">
        <div class="content">
          <h3>New Palestinain??</h3>
          <p>Sign Up now and be part of Our kingdom!.</p>
          <button class="btn transparent" id="sign-up-btn">
            <a href="signup.php" class="no-style-link">Sign Up</a>
          </button>
        </div>

      </div>
    </div>
  </div>
  <?php include 'footer.html'; ?>

</body>

</html>