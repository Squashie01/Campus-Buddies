<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

        <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

        <title> Campus Buddy | Homepage </title>

        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    <?php
        session_start();
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "campusbuddies";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $qry="SELECT StudentID, TeacherId  FROM login";
        $result=mysqli_query ($conn, $qry);

        $logedin="f";

        while($row = $result ->fetch_assoc())
         {
             if((($_SESSION['id'] == $row["StudentID"]) || ($_SESSION['id'] == $row["TeacherId"])))
             {
                $logedin="t";
             }
         }
        if ($logedin !="t")
        {
            session_destroy();
            header("location: ../code/login.html");
        }
    ?>
    <form action="../php/logout.php">
        <button type="submit"> logout </button>
    </form>
    </body>
</html>