<?php 
session_start();
if (isset($_SESSION["role"])) {
    header("Location:index.php");
} 
else{
    ?>
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
    <link rel="stylesheet" href="back.css">
    <script>

    </script>
</head>
<body style="background-color: #efefef;">

<div class="container">
    
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <img src="img/logo.png" class="shadow p-1 mb-2 bg-white border-0" alt="logo" style="width: 100%;height: 120px;">
            <!-- admin login form -->
            
                
                <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
                <?php 
                        $err = array('username'=>'','pass'=>'','wrong'=>'');
                        $user = $pass ='';
                        require("admin/connect.php");
                        if (isset($_POST['login'])) {

                            if (empty($_POST["user_name"])) {
                                $err['username'] = "User Name is required!";
                            }else{
                                $user = htmlspecialchars($_POST["user_name"]) ;
                            }
                            if (empty($_POST["user_pass"])) {
                                $err["pass"] = "Password is required!";
                            }else{
                                $pass = $_POST["user_pass"];
                            }
                            if (!array_filter($err)) {
                            $sql_check = "SELECT user_id, user_name, user_role FROM user WHERE user_name = '{$user}' AND user_password = '{$pass}'";
                                $result = mysqli_query($con,$sql_check) or die(mysqli_error($con));
                                if (mysqli_num_rows($result)>0) {
                                    
                                    $row = mysqli_fetch_assoc($result);
                                    
                                    $_SESSION["user_id"] = $row["user_id"];
                                    $_SESSION["username"] = $row["user_name"];
                                    $_SESSION["role"] = $row["user_role"];
                                    if ($_SESSION['role']=='Admin') {
                                        header("Location:admin/postlist.php");
                                    }else {
                                        header("Location:index.php");
                                    }
                                    
                                }else{
                                    $user = $pass ='';
                                    $err['wrong'] = "<div class='alert alert-danger'><i class='fas fa-exclamation-circle'></i>Username or Password is incorrect!</div>";
                                }
                            }
                        }

                      
                      ?>  
                    <h2 class="h3 text-center">Admin</h2>
                    <?php echo $err['wrong']; ?>
                    <form method="POST" action="">
                    <div class="form-group">
                        <label for="Inputuser">User Name</label>
                        <input type="text" value="<?php echo $user ;?>" name="user_name" class="form-control" id="eInputEmail" placeholder="Enter email">
                        <div class="text-danger"><?php echo $err['username']; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" name="user_pass" class="form-control" id="InputPassword" placeholder="Password">
                        <div class="text-danger"><?php echo $err['pass']; ?></div>
                    </div>
                    
                    <input type="submit"  class="btn btn-primary btn-block" name="login" value="Login">
                    <a href="register.php"  class="btn btn-info btn-block" >New Registration</a>
                </form>


                </div>  
            </div>
        </div>
        <div class="col-md-4"></div>

    </div>
</div>
</body>
</html>
<?php } ?>