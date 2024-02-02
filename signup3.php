<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['confirm_password'] = $confirm_password;

}



$name = $_SESSION['fullname'];
$flat = $_SESSION['flat'];
$street = $_SESSION['street'];
$city = $_SESSION['city'];
$country = $_SESSION['country'];
$dob = $_SESSION['dob'];
$email = $_SESSION['emailD'];
$tel = $_SESSION['tel'];
$cc_number = $_SESSION['cc_number'];
$cc_exp = $_SESSION['CC_E'];
$cc_name = $_SESSION['cc_name'];
$cc_bank = $_SESSION['cc_bank'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Step 3</title>
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

    <form action="baseSaver.php"  method="POST" class="sign-up-form">
                    <h2 class="title">Sign Up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>

                    </div>
                    <div class="input-field">
                        <i class="fas fa-building"></i>
                        <input type="text" id="flat" name="flat" value="<?php echo $flat; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-car"></i>
                        <input type="text" id="street" name="street" value="<?php echo $street; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-city"></i>
                        <input type="text" id="city" name="city" value="<?php echo $city; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-city"></i>
                        <input type="text" id="country" name="country" value="<?php echo $country; ?>" required><br>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-calender"></i>
                        <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="emailD" value="<?php echo $email; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="tel" name="tel" value="<?php echo $tel; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-address-card"></i>
                        <input type="text" id="cc_number" name="cc_number" value="<?php echo $cc_number; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-calender"></i>
                        <input type="date" id="cc_exp" name="cc_exp" value="<?php echo $cc_exp; ?>" required><br>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-address-card"></i>
                        <input type="text" id="cc_name" name="cc_name" value="<?php echo $cc_name; ?>" required><br>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-address-card"></i>
                        <input type="text" id="cc_bank" name="cc_bank" value="<?php echo $cc_bank; ?>" required><br>
                    </div>
                    <input type="submit" value="Finish" class="btn solid" />

              
                </form>
            </div>
        <div class="panel left-panel">
            <div class="content">
                <h3>Confirm You Information</h3>
                </div>
                </div>

            </div>


</body>

</html>


