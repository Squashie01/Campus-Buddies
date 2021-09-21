<?php
    if(isset($_POST['submit']))
    {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $firstname=$_POST['First_Name'];
        $lastName=$_POST['Last_Name'];
        $phoneNumber=$_POST['number'];
        $email=$_POST['email'];
        $password2=$_POST['password'];
        $fileActualName=explode($fileName,'.' );
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        $fullName=$firstname . $lastName .time() . rand();
        
        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $folderC= $firstname.$lastName.time();

                    mkdir("../uploads/" .$folderC);

                    $fileNameNew = $firstname.$lastName.uniqid('', true).".".$fileName;
                    $fileDestination = '../uploads/'.$folderC."/" .$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../code/sighn_up.php?$fileActualName");

                
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "campus_buddies";
                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    $qry="SELECT * FROM  student";
                    $result=mysqli_query ($conn, $qry);

                    $idN=rand(1000,10000);

                    $uploadPic="INSERT INTO student(Picture, First_Name, Last_name, Email, 	StudentId)
							  VALUES ('$fileDestination', '$firstname', '$lastName', '$email', '$idN');";
                              mysqli_query($conn, $uploadPic); 
                    
                              while($row = $result ->fetch_assoc())
                              {
                                  echo  "<img src='$row[Picture]' alt='crap'>";
                              } 
                    
                    $qry="SELECT * FROM  studentlogin";
                    $result=mysqli_query ($conn, $qry);
                    
                    $uploadPass="INSERT INTO studentlogin(StudentId, Password)
                    VALUES ('$idN', '$password2');";
                    mysqli_query($conn, $uploadPass); 
          

                }
                else
                {
                    echo("your file is to big");
                }
            }
            else
            {
                echo"there was en error uploading your file";
            }
        }
        else 
        {
            echo "you cannot upload files of this type";
        }
    }
    else 
    {
        echo "crap";
    }
?>