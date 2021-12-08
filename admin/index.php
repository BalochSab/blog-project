<?php 
session_start();
if (isset($_SESSION["role"]) & $_SESSION['role']=='Admin') {

header("Location:postlist.php") ;
}
else {

header("Location:../index.php") ;
    
}

?>