<!DOCTYPE html>
<html lang="en">


<head>
    <link rel="stylesheet" type="text/css" href="signup.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

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
                </ul>
            </nav>
        </header>
    </div>
    <div class="container">
        <div class="forms-container">
            <div class="signup">
                <form action="signup2.php" method="POST" class="sign-up-form">
                    <div class="input">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="fullname" placeholder="Name" />
                    </div>
                    <div class="input">
                        <i class="fas fa-building"></i>
                        <input type="text" id="flat" name="flat" placeholder="Flat/House No.">
                    </div>
                    <div class="input">
                        <i class="fas fa-car"></i>
                        <input type="text" id="street" name="street" placeholder="Street">
                    </div>
                    <div class="input">
                        <i class="fas fa-city"></i>
                        <input type="text" id="city" name="city" placeholder="City">
                    </div>
                    <div class="input">
                        <i class="fas fa-city"></i>
                        <input type="text" id="country" name="country" placeholder="Country"><br>
                    </div>

                    <div class="input">
                        <i class="fas fa-calender"></i>
                        <input type="date" id="dob" name="dob" placeholder="dob" />
                    </div>
                    <div class="input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="emailD" placeholder="Email" />
                    </div>
                    <div class="input">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="tel" name="tel" placeholder="Phone Number" />
                    </div>
                    <div class="input">
                        <i class="fas fa-address-card"></i>
                        <input type="text" id="cc_number" name="cc_number" placeholder="Creadit card" />
                    </div>
                    <div class="input">
                        <i class="fas fa-calender"></i>
                        <input type="date" id="cc_exp" name="CC_E" placeholder="CC_E Date" />
                    </div>
                    <div class="input">
                        <i class="fas fa-address-card"></i>
                        <input type="text" id="cc_name" name="cc_name" placeholder="Name on card" />
                    </div>

                    <div class="input">
                        <i class="fas fa-address-card"></i>
                        <input type="text" id="cc_bank" name="cc_bank" placeholder="cc_bank" />
                    </div>
                    <input type="submit" value="Next" class="btn solid" />

                </form>
            </div>
        </div>
        <div class="panel left-panel">
            <div class="content">
                <h3>Already have an account?</h3>
                <p>Sign in now to access your account.</p>
                <button class="btn transparent">
                    <a href="login.php" class="no-style-link">Sign In</a>
                </button>
            </div>
        </div>
    </div>
    <?php include 'footer.html'; ?>

</body>

</html>