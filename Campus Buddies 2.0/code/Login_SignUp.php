<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

    <title> Campus Buddy | Login or Sign Up</title>

    <link rel="stylesheet" href="../css/style.css">
    <?php
        session_start();
        $_SESSION['login_error']="n";
    ?>
</head>
<body>

    <div class="LSContainer">
        <div class="LSLogo">
            <img src="../images/CampusBuddiesTextLogo.png" alt="Campus Buddy Logo">
        </div>
        <div class="LSButtons">
            <a href="Login.php">
                <div class="LoginPageBtn" id="buttonCSS">
                    Login
                </div>
            </a>
            <a href="sighn_up.php">
                <div class="SignUpPageBtn" id="buttonCSS">
                    Sign Up
                </div>
            </a>
        </div>
    </div>

</body>
</html>