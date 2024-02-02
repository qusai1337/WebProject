<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullname'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $dob = $_POST['dob'];
    $email = $_POST['emailD'];
    $tel = $_POST['tel'];
    $cc_number = $_POST['cc_number'];
    $cc_exp = $_POST['CC_E'];
    $cc_name = $_POST['cc_name'];
    $cc_bank = $_POST['cc_bank'];

    $_SESSION['fullname'] = $name;
    $_SESSION['flat'] = $flat;
    $_SESSION['street'] = $street;
    $_SESSION['city'] = $city;
    $_SESSION['country'] = $country;
    $_SESSION['dob'] = $dob;
    $_SESSION['emailD'] = $email;
    $_SESSION['tel'] = $tel;
    $_SESSION['cc_number'] = $cc_number;
    $_SESSION['CC_E'] = $cc_exp;
    $_SESSION['cc_name'] = $cc_name;
    $_SESSION['cc_bank'] = $cc_bank;

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Step 2</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header-container1">
        <header>
            <nav>
                <ul>
                    <li><a href="inter.html">Home</a></li>
                    <li><a href="store.html">Store</a></li>
                    <li><a href="about.html">About</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <div class="container">
        <div class="forms-container">
            <div class="signup">
                <form action="signup3.php" method="POST" class="sign-up-form">
                    <h2 class="title">Sign Up - Step 2</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
                    </div>

                    <input type="submit" value="Next" class="btn solid" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>
