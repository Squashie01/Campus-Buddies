<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

    <title> Campus Buddy | Login </title>

    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="LoginPageContainer">
        <div class="LoginContainer">

            <div class="LoginHeader">
                <div class="LoginBack">
                    <a href="Login_SignUp.html"> <i class="fas fa-chevron-left"></i> </a>
                </div>
                <div class="LoginText">
                    Login
                </div>
            </div>
            <?php
                session_start();
                $badLogin=$_SESSION['login_error'];
                if($badLogin == "y")
                {
                    echo
                    "
                        <div class='LoginForm'>
                            <form action='../php/login.php' method='post'>
                                <label for='StudentId'> Student ID </label>
                                <input type='text' name='studentId'> <br>
                                <br>
                                <label for='Password'> Password </label>
                                <input type='password' name='uPassword'> <br>
                                <br>
                                <br>
                                <div class='LoginBtn' id='buttonCSS'> <button  type='submit'> Login </button>  </div>
                            </form>
                        </div> 
                    " . "your login creduntuals are wrong";
                }
                else
                {
                    echo
                    "
                        <div class='LoginForm'>
                            <form action='../php/login.php' method='post'>
                                <label for='StudentId'> Student ID </label>
                                <input type='text' name='studentId'> <br>
                                <br>
                                <label for='Password'> Password </label>
                                <input type='password' name='uPassword'> <br>
                                <br>
                                <br>
                                <div class='LoginBtn' id='buttonCSS'> <button  type='submit'> Login </button>  </div>
                            </form>
                        </div>
                    ";
                }
                $_SESSION['login_error']="n";
            ?>

        </div>
    
        <div class="bottomLogo">
            <img src="../images/CampusBuddiesTextLogo.png" alt="Campus Buddy Logo">
        </div>
    </div>

</body>
</html>