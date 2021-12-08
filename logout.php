<?php 

session_start();
session_destroy();
unset($_SESSION['role']);
unset($_SESSION['user_id']);
unset($_SESSION['username']);
header("Location:index.php");
?>