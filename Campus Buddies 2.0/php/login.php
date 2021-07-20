<html>
    <body>
        <?php
            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "campus_buddies";
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $studentId=$_POST['studentId'];
            $uPassword=$_POST['uPassword'];

            $qry="SELECT StudentID, Password FROM student";
            $result=mysqli_query ($conn, $qry);

            while($row = $result ->fetch_assoc())
            {
                if($studentId == $row["StudentID"]  && $uPassword == $row["Password"])
                {
                    $_SESSION["id"]=$row["StudentID"];
                    header("Location: Homepage.php");
                }
                else 
                {
                    echo "falure";
                }
            }
        ?>
    </body>
</html>