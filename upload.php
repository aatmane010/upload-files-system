<?php
    session_start();
    include_once 'dbh.inc.php';

    $id = $_SESSION['id'];

    if(isset($_POST['upload'])){
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt)); // convert extnetion to lower case

        // allowed extention to upload
        $allowedExt = ['jpg', 'jpeg', 'png', 'pdf'];

        if(in_array($fileActualExt, $allowedExt)){
            if($fileError === 0){
                if($fileSize < 500000){
                    $fileNewName = "profile".$id.".".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNewName;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    $sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
                    $result = mysqli_query($conn, $sql);

                    header("Location: index.php?upload=success");
                }
                else{
                    echo "This file is too larg!";
                }
            }
            else{
                echo "There is an error. You can't upload this file! Try again.";
            }
        }
        else{
            echo "You can't upload files of this type!";
        }
    }