
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

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
<link rel="stylesheet" href="style.css">
<script>

</script>
</head>
<body style="background-color: #efefef;">
    <div class="container-fluid">
        <!-- head or log place -->
        <div class="row bg-primary">
            <div class="col-md-1"></div>
            <div class="col-md-5 ">
                <img src="img/logo.png" alt="news logo" class="img-thumbnail" style="width:120px;height:50px;">
            </div>
        </div>
        </div>
        <!-- nav bar place -->
        <nav class="navbar navbar-expand-md bg-white text-black sticky-top navbar-dark ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse font-weight-bold" id="collapsibleNavbar">
                <div class="container ">
                    <ul class="navbar-nav ml-5 ">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="postlist.php" >Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="categorylist.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="userList.php">users</a>
                        </li>
                    </ul>
                    <div class="float-right">
                    <div class="float-left m-2 h5"><?php echo "Welcome ".$_SESSION["username"];?></div>
                    <a class="btn btn-danger rounded-0 float-right" role="button" href="../logout.php"><i class="fas fa-sign-out-alt" id="hideIcon"> </i> Logout</a>
                    </div>
                </div>
            </div>  
        </nav>
        

    