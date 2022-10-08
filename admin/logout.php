<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["user_name"]);
    header("Location:login.php");
?>