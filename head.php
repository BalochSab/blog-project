<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title></title> -->
    <?php  session_start();
    $title = basename($_SERVER['PHP_SELF']);
        if (isset($_GET["postIdDetail"])) {
           echo "<title></title>";
        }
        elseif (isset($_GET["categoryIdPost"])) {
            echo "<title>Category</title>";
        }
        elseif (isset($_GET["userIdpost"])) {
            echo "<title>User Post</title>";
        }
        elseif (isset($_GET["search"])) {
            echo "<title>Search</title>";
        }        
        elseif (isset($_GET["home"])) {
            echo "<title>Home</title>";
        }
        else {
            echo "<title>Home</title>";
        }
        
         ?>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- font Awosame -->
<script src="https://kit.fontawesome.com/997d2022e2.js" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="back.css"> -->

</head>
<body style="background-color: #efefef;">
    <div class="container-fluid bg-white">
        <!-- head or log place -->
        <div class="row ">
            <div class="col-md-12">
                <a href="index.php" class="" ><img src="img/logo.png" alt="news logo" style="width:300px;height: 100px;"></a>
            </div>
        </div>
        </div>
        <!-- nav bar place -->
        <nav class="navbar navbar-expand-md bg-primary sticky-top navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-white" id="collapsibleNavbar">
                <ul class="navbar-nav ">
                <li class="nav-item ">
                    <a class="nav-link text-white" href="index.php?home">Home</a>
                </li>
                <?php 
                    include("admin/connect.php");
                    $sqlcat = "SELECT * FROM category";
                    $catlist = mysqli_query($con,$sqlcat);
                    while($show = mysqli_fetch_assoc($catlist)) { 
                        if ($show['num_of_post']>0) {
                        ?>
                    
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?categoryIdPost=<?php echo $show['category_id']?>">
                            <?php echo $show['category_name']?>
                        </a>
                        </li>
                            <?php }
                         }
                         echo "</ul>";
                         if (isset($_SESSION["role"])) {?>
                               
                        <ul class="navbar-nav ml-auto">                
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">            Dropdown on Right</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="logout.php">logout</a>
                                </div>
                            </li>
                        </ul>
                        
                       <?php  } 
                       else{?>
                         <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="register.php" class="nav-link text-white btn btn-info float-right  my-2 my-sm-0 ml-1 mr-1" roll="button" >Register</a>
                            </li>
                            <li class="nav-item">
                                <a  href="login.php" class="nav-link text-white btn btn-success my-2 float-right my-sm-0 ml-1 mr-1" roll="button">login</a>
                            </li>
                        </ul>
                        
                       <?php }?>
            </div>  
        </nav>

    