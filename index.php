<?php
    session_start();
    include_once 'dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Files - Using PHP</title>
    </head>
    <body>
        <?php
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $sqlImg = "SELECT * FROM profileimg WHERE userid=$id";
                    $resultImg = mysqli_query($conn, $sqlImg);

                    while($rowImg = mysqli_fetch_assoc($resultImg)){
                        echo "<div>";
                            if($rowImg['status'] == 0){
                                echo "<img src='uploads/profile".$id.".jpg?'".mt_rand().">";
                            }
                            else{
                                echo "<img src='uploads/profiledefault.jpg'>";
                            }
                            echo $row['username'];
                        echo "</div>";
                    }
                }
            }
            else{
                echo "There are no users yet!";
            }

            if(isset($_SESSION['id'])){
                if($_SESSION['id'] == 1){
                    echo "You are logged in as User";
                }
                echo '
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <button type="submit" name="upload">Upload</button>
                    </form>
                ';

                echo '
                    <form action="delete.php" method="POST">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                ';
            }
            else{
                echo "You are not logged in";
                echo '
                    <h2>Sign Up</h2>
                    <form action="signup.php" method="POST">
                    <input type="text" name="firstname" placeholder="First name">
                    <input type="text" name="lastname" placeholder="Last name">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="signup-btn">Sign Up</button>
                    </form>
                ';
            }
        ?>

        <h2>Login as User</h2>
        <form action="login.php" method="POST">
            <button type="submit" name="login-btn">Login</button>
        </form>

        <h2>Logout as User!</h2>
        <form action="logout.php" method="POST">
            <button type="submit" name="logout-btn">Logout</button>
        </form>
    </body>
</html>