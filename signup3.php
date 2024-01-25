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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 3</title>
</head>

<body>
    <?php

    $name = $_SESSION['name'];
    $flat = $_SESSION['flat'];
    $street = $_SESSION['street'];
    $city = $_SESSION['city'];
    $country = $_SESSION['country'];
    $dob = $_SESSION['dob'];
    $email = $_SESSION['email'];
    $tel = $_SESSION['tel'];
    $cc_number = $_SESSION['cc_number'];
    $cc_exp = $_SESSION['cc_exp'];
    $cc_name = $_SESSION['cc_name'];
    $cc_bank = $_SESSION['cc_bank'];
    ?>

    <h2>Confirm Your Information</h2>

    <form action="inter.html" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>

        <label for="flat">Flat/House No.:</label>
        <input type="text" id="flat" name="flat" value="<?php echo $flat; ?>" required><br>

        <label for="street">Street:</label>
        <input type="text" id="street" name="street" value="<?php echo $street; ?>" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo $city; ?>" required><br>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" value="<?php echo $country; ?>" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

        <label for="tel">Phone Number:</label>
        <input type="tel" id="tel" name="tel" value="<?php echo $tel; ?>" required><br>

        <label for="cc_number">Credit Card Number:</label>
        <input type="text" id="cc_number" name="cc_number" value="<?php echo $cc_number; ?>" required><br>

        <label for="cc_exp">Credit Card Expiration Date:</label>
        <input type="date" id="cc_exp" name="cc_exp" value="<?php echo $cc_exp; ?>" required><br>

        <label for="cc_name">Name on Card:</label>
        <input type="text" id="cc_name" name="cc_name" value="<?php echo $cc_name; ?>" required><br>

        <label for="cc_bank">Bank Name:</label>
        <input type="text" id="cc_bank" name="cc_bank" value="<?php echo $cc_bank; ?>" required><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>


