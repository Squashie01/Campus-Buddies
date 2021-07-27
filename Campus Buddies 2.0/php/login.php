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


            $qry="SELECT * FROM studentlogin";
            $result=mysqli_query ($conn, $qry);

            while($row = $result ->fetch_assoc())
            {
                if(($studentId == $row["StudentId"])  && ($uPassword == $row["Password"]))
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
            } 
        ?>
    </body>
</html>