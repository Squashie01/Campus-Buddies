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
                    $fileNameNew = $firstname. $lastName.uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../uploads/' .$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../code/sighn_up.php?uploadsuccess");
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