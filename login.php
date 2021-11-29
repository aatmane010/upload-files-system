<?php
    session_start();

    if(isset($_POST['login-btn'])){
        $_SESSION['id'] = 1;

        header("Location:  index.php?login=success");
    }