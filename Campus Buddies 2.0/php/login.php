<html>
    <body>
        <?php
        session_start();
            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "campusbuddies";
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $studentId=$_POST['studentId'];
            $uPassword=$_POST['uPassword'];

            $qry="SELECT StudentID, Password, TeacherId  FROM login";
            $result=mysqli_query ($conn, $qry);

            while($row = $result ->fetch_assoc())
            {
                if((($studentId == $row["StudentID"]) || ($studentId == $row["TeacherId"]))  && ($uPassword == $row["Password"]))
                {
                    $_SESSION['id']=$studentId;
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