<?php
    session_start();
    if(!isset($_SESSION['user_id']))
        header("location:index.php");
    /*else if(isset($_SESSION['id']))
        header("location:home.php");*/
?>