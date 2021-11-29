<?php
    session_start();
    include_once "dbh.inc.php";

    $sessionid = $_SESSION['id'];

    $fileName = "uploads/profile".$sessionid."*";
    $fileInfo = glob($fileName);
    $fileExt = explode(".", $fileInfo[0]);
    $fileActualExt = $fileExt[1];