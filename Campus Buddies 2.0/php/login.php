<html>
    <body>
        <?php
        session_start();
            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "campus_buddies";
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $studentId=$_POST['studentId'];
            $uPassword=$_POST['uPassword'];
            $succes="n";


            $qry="SELECT * FROM studentlogin";
            $result=mysqli_query ($conn, $qry);

            //this is to see wether or not they are a student 
            while($row = $result ->fetch_assoc())
            {
                if(($studentId == $row["StudentId"])  && ($uPassword == $row["Password"]))
                {
                   $succes="y";
                }
            } 

            $qry1="SELECT * FROM teacherlogin";
            $result1=mysqli_query ($conn, $qry1);

            //this is to see wether or not they are a teacher
            while($row = $result1 ->fetch_assoc())
            {
                if(($studentId == $row["TeacherId"])  && ($uPassword == $row["Password"]))
                {
                   $succes="y";
                }
            }

            //this allwos the user to login or reject 
            if ($succes == "y")
            {
                $_SESSION['login_error']="n";
                $_SESSION['id']=$studentId;
                header("Location: Homepage.php");
            }
            else
            {
                $_SESSION['login_error']="y";
                header("Location: ../code/Login.php");
            }
        ?>
    </body>
</html>