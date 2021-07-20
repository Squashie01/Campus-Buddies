<html>
	<head>
		<title> Campus Buddies | Home </title>

		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="JavaScript.js"></script>
	</head>
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "campus_buddies";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			$fname=$_POST['fName'];
			$lname=$_POST['lName'];
			$email=$_POST['email'];
			$cResults=$_POST['results'];
			$id=rand(1000000, 9999999);
			$repeat="";
			$picExtend="";
			$allowedEx="";
			$picExtend=explode('.', $cResults);
			$allowedEx=array('jpg', 'jpeg', 'png');
			$nCResults="";
			
			$SameU="";
			$qry="SELECT studID FROM student";
			$result=mysqli_query ($conn, $qry);
			
			$test="INSERT INTO student( CXCResults)
							  VALUES ( '$picExtend');";
						mysqli_query($conn, $test);
			if(($picExtend == $allowedEx[0]) || ($picExted==$allowedEx[1]) || ($picExtend == $allowedEx[2]))
			{
				$nCResults=$cResults . "." . $picExtend;
				$folderUp='results/'.$nCResults;
				move_uploaded_file($nCResults, $folderUp);
			}
			else 
			{
				echo"something went wrong";
			}
			if ($result->num_rows> 0) 
			{
				while($row = $result->fetch_assoc()) 
					{
						//echo $row["Username"];
						//echo "<br />";
						if ($row["studID"] == $id)
						{
							$repeat="true";
						}
						if ($repeat == "true")
						{
							while($row["studID"] == $id)
							{
								$id=rand(1000000, 9999999);	
							}
						}
					}
			}
			$log="INSERT INTO student(studID, firstName, lastName, email, CXCResults)
							  VALUES ('$id', '$fname', '$lname', '$email', '$nCResults');";
						mysqli_query($conn, $log);
					
					echo "<br/>"."<br/>"."<br/>"."<br/>"."<br/>"."<br/>"."<br/>".
					"you will get an email to notify you if you have been accepted or not, with the relative information";
					echo"<h1> This is to test if the image works</h1>";
					while($row = $result->fetch_assoc()) 
					{
						echo "<img src='{$data['CXCResults']}' width='40%' height='40%'";
					}
			mysqli_close($conn);
		?>
	</body>
</html>