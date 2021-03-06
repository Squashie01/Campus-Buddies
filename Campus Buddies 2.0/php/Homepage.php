<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

    <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

    <title> Campus Buddy | Homepage </title>

    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <!-- This is the Navigation Bar -->
    <nav class="navbar">
        <div class="logo"> <img src="../images/CampusBuddiesTextLogo.png" alt=""> </div>

        <div id="sidebar">
            <div class="toggle-btn" onclick ="show()">
              <div id="openMenu"><i class="fa fa-bars"></i></div>
            </div>

            <div class="closeMenu" onclick ="hide()"><i class="fa fa-times"></i></div>

            <ul>
              <a href="php/Homepage.php"> <li class="active">Home</li> </a>
              <li>Student Support</li>
              <a href="StudentID.php"> <li>Student ID Profile</li> </a>
              <li>Semester Calendar</li>
              <li>Library</li>
            </ul>
        </div>
    </nav>


    <!-- This is the Section Below the Navigation Bar -->
    <?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "campus_buddies";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $qry="SELECT StudentID, First_Name, Picture  FROM student";
            $result=mysqli_query ($conn, $qry);

        $didTheyLogIn="n";
        $firstName="defult";
        $picture = "default";
        $studentId=$_SESSION['id'];

        //this checks for if they are a student
        while($row = $result ->fetch_assoc())
        {
            if($studentId == $row["StudentID"]) 
            {
                $firstName = $row["First_Name"];
                $picture = $row["Picture"];
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

        echo
        "
            <div class='userBar'>
                <span> Hi, ". $firstName . " </span>
                <a href='StudentProfile.php'> <img src=" . $picture . " alt=''> </a>
            </div>
        "
    ?>

    <!-- Carosel goes here -->
    <div class="swiper-container mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"> 
                <img src="https://th.bing.com/th/id/OIP.pV7QklQsth6Xat9CS3vwtAHaDr?pid=ImgDet&rs=1" alt="">
                <span> Registration Dates For Electives </span>
                <button> See More Info </button>
            </div>

            <div class="swiper-slide"> 
                <img src="https://th.bing.com/th/id/OIP.pV7QklQsth6Xat9CS3vwtAHaDr?pid=ImgDet&rs=1" alt="">
                <span> Registration Dates For Electives </span>
                <button> See More Info </button>
            </div>

            <div class="swiper-slide"> 
                <img src="https://th.bing.com/th/id/OIP.pV7QklQsth6Xat9CS3vwtAHaDr?pid=ImgDet&rs=1" alt="">
                <span> Registration Dates For Electives </span>
                <button> See More Info </button>
            </div>

            <div class="swiper-slide"> 
                <img src="https://th.bing.com/th/id/OIP.pV7QklQsth6Xat9CS3vwtAHaDr?pid=ImgDet&rs=1" alt="">
                <span> Registration Dates For Electives </span>
                <button> See More Info </button>
            </div>
        </div>
    </div>

    <!-- This is the search bar -->
    <div class="ServicesSearchBar">
        <input type="text" placeholder="Search for & add services">
    </div>

    <!-- This is the discover section -->
    <div class="DiscoverText">
        <span> Discover </span>
    </div>

    <div class="Services">
        <div class="ServiceBox">
            <img src="../images/CampusBuddyNoText.png" alt="">
            <span> Student Support </span>
        </div>

        <div class="ServiceBox">
            <img src="../images/CampusBuddyNoText.png" alt="">
            <span> Student ID Profile </span>
        </div>

        <div class="ServiceBox">
            <img src="../images/CampusBuddyNoText.png" alt="">
            <span> Semester Calendar </span>
        </div>

        <div class="ServiceBox">
            <img src="../images/CampusBuddyNoText.png" alt="">
            <span> Library </span>
        </div>
    </div>


    <!-- Bottom Navigation Bar -->
    <div class="bottomNavBar">
        <ul class="BottomNavUl">
            <li class="borderSettings"> <a href=""> <i class="fas fa-exclamation-triangle"></i> </a> </li>
            <li class="borderSettings"> <a href="Homepage.php" class="activePage"> <i class="fas fa-home"></i> </a> </li>
            <li class="borderSettings"> <a href="Calendar.html"> <i class="far fa-calendar-alt"></i> </a> </li>
            <li class="borderSettings"> <a href="Notifications.html"> <i class="fas fa-bell"></i> </a> </li>
        </ul>
    </div>
    
    <script src="../js/navBar.js"></script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>

</body>
</html>