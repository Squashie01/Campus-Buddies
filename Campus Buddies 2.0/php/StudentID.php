<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>


    <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

    <title> Campus Buddy | Student ID </title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- This is the Navigation Bar -->
    <nav class="navbar" id="navbar">       

        <div class="StudentIdBackButton">
            <i class="fas fa-chevron-left"></i>
        </div>

        <div class="NotificationAndSettings">
            <div> <i class="fas fa-bell"></i> </div>
            <div> <i class="fas fa-cog"></i> </div>
        </div>
    </nav>

    <?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "campus_buddies";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $qry="SELECT StudentID, First_Name, Last_name, Picture  FROM student";
        $result=mysqli_query ($conn, $qry);

        $didTheyLogIn="n";
        $firstName="default";
        $lastName = "default";
        $picture = "default";
        $studentId=$_SESSION['id'];

        //this checks for if they are a student
        while($row = $result ->fetch_assoc())
        {
            if($studentId == $row["StudentID"]) 
            {
                $firstName = $row["First_Name"];
                $lastName = $row["Last_name"];
                $picture=$row["Picture"];
                $didTheyLogIn = "y";
                //echo "this works";
               // echo $row["First_Name"];
            }
        }

        //this checks to see if they are a teacher
        if($didTheyLogIn == "n")
        {
            $qry="SELECT TeacherId , First_Name  FROM teacher";
            $result=mysqli_query ($conn, $qry);

            while($row = $result ->fetch_assoc())
            {
                if($studentId == $row["TeacherId"]) 
                {
                    $firstName = $row["First_Name"];
                    $didTheyLogIn = "y";
                }
            }
        }

        //this is if a user tried to enter without loging in 
        if ($didTheyLogIn == "n")
        {
            header("location: ../php/logout.php");
        }
        /*
        if($didTheyLogIn == "n")
        {
            $qry="SELECT TeacherId , First_Name  FROM teacher";
            $result=mysqli_query ($conn, $qry);

            while($row = $result ->fetch_assoc())
            {
                if($studentId == $row["TeacherId"]) 
                {
                    $firstName = $row["First_Name"];
                    $didTheyLogIn = "y";
                }
                else 
                {
                $didTheyLogIn = "n";
                }
            }

        }

        if($didTheyLogIn == "n")
        {
            session_destroy();
            session_start();
            $_SESSION['login_error']="y";
            //header("location: ../code/login.php");
        }
        */

        /* Student Id Info */
        echo
        '
            <div class="StudentIdInfo">
                <div class="StudentIdPhoto">
                    <img src="' . $picture . '" alt="damm">
                </div>
                <span class="StudentIdName"> '. $firstName . ' ' . $lastName . ' </span>
                <span class="StudentIdType"> Full-Time Student</span>
                <span class="StudentIdIdNum"> Student ID # </span>
                <span class="StudentIdNumber"> ' . $studentId . ' </span>
                <span class="StudentIdDivision"> Division </span>
                <span class="StudentIdDivisionName"> Fine Arts </span>
                <div class="StudentIdBarcode">
                    <img src="https://th.bing.com/th/id/OIP.HtmS7mNn7k32_cnCShU03gAAAA?pid=ImgDet&rs=1" alt="">
                </div>
                <span class="StudentIdYear"> YEAR 2020-2021 </span>
            </div>
        '
    ?>

    
    

    <!-- Bottom Navigation Bar -->
    <div class="bottomNavBar">
        <ul class="BottomNavUl">
            <li class="borderSettings"> <a href="#"> <i class="fas fa-exclamation-triangle"></i> </a> </li>
            <li class="borderSettings"> <a href="#"> <i class="fas fa-home"></i> </a> </li>
            <li class="borderSettings"> <a href="#"> <i class="far fa-calendar-alt"></i> </a> </li>
            <li class="borderSettings"> <a href="#"> <i class="fas fa-bell"></i> </a> </li>
        </ul>
    </div>

    <script src="../js/navBar.js"></script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 4,
          spaceBetween: 15,
          loop: true,
        });
      </script>
    

</body>
</html>