<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

        <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

        <title> Campus Buddy | Sign Up </title>

        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="LoginHeader">
            <div class="LoginBack">
                <a href="Login_SignUp.html"> <i class="fas fa-chevron-left"></i> </a>
            </div>
            <div class="LoginText">
                Registration
            </div>
        </div>
        <div class='LoginForm'>
            <form action="../php/sign_up.php" method="POST" enctype="multipart/form-data">
                <p>First Name </p>
                <input type="input" name="First_Name">
                </br>
                <p>Last Name</p>
                <input type="input" name="Last_Name"> 
                </br>
                <p> email </p>
                <input type="email" name="email">
                </br>
                <p> phone number</p>
                <input type="input" name="number">
                <br/>
                <p>Please upload your jpg file </p>
                <input type="file" name="file">
                </br>
                </br>
                <button type="submit" name="submit"> UPLOAD </button>
            </form>
        </div>
    </body>
</html>