<?php 
session_start();
if (isset($_SESSION["role"])) {
// ob_start();
header("Location:index.php");
}else{
    
    $fname = $lname = $uname = $uemail = $upass = $urole  = $img_name = $ugender =  '';
    
    $errors = array('ext'=>'','imgSize'=>'');
    $ex = array('err'=>'', 'efname'=>'', 'elname'=>'', 'euname'=>'', 'euemail'=>'', 'eupass'=>'','eugender'=>'');
    if (isset($_POST["adduser"])) {
    
    if (empty($_POST["first_name"])) {
        $ex['efname'] = "First Name is required!";
    }else{
        $fname = $_POST["first_name"];
    }
    if (empty($_POST["last_name"])) {
        $ex['elname'] = "Last Name is required!";
    }else{
        $lname = $_POST["last_name"];
    }
    if (empty($_POST["email"])) {
        $ex['euemail'] = "Email is required";
    }else{
        $uemail = $_POST["email"];
    }
    if (empty($_POST["user_name"])) {
        $ex['euname'] = "User Name is required";
    }else{
        $uname = $_POST["user_name"];
    }
    if (empty($_POST["pass"])) {
        $ex['eupass'] = "Password is required";
    }else{
        $upass = $_POST["pass"];
    }
    if (empty($_POST["gender"])) {
        $ex['eugender'] = "Please Select Gender";
    }else{
        $ugender = $_POST["gender"];
    }
   
    if (!array_filter($ex)){
     include("admin/connect.php");
     $check_user = "SELECT user_email FROM user WHERE user_email = '".$uemail."'";
        $ucheck = mysqli_query($con, $check_user) or die(mysqli_error($con));
        $udata = mysqli_num_rows($ucheck);
        if ($udata > 0) {
            $ex['euemail'] =  "Email Already in Exists<br/>";
        }
        else{
            if (isset($_FILES['image'])) {
               
                
                
                $img_name = $_FILES['image']['name'];
                $img_size = $_FILES['image']['size'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $img_type = $_FILES['image']['type'];
                // echo "else $img_name";
                // $ext_dot = explode('.',$img_name);
                // $img_ext =  end($ext_dot);
                $extensions = array("jpeg","jpg","png");
                $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);

            
                if (!in_array($img_ext,$extensions)) {
                    $errors['ext'] = "This extension file not allowed, Please choose a JPG or PNG file";
                }
                
                if ($img_size > 2097152) {
                    $errors['imgSize'] = "File size must be 2MB or lower ";
                }
                
                if (!array_filter($errors)) {
                    move_uploaded_file($img_tmp,"admin/upload-img/". $img_name) ;//or die("file not uploaded");
                }else {
                    $errors['imgSize'] = "There is an error with you Image";

                } 
                
            } 
            if ($img_name=='') {
                $img_name = 'user.png';
            }
        
        
            $urole= 'User'; 
            $add_user = "INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_email`, `user_name`, `user_password`, `user_gender`, `user_img`, `user_role`) VALUES (NULL, '{$fname}', '{$lname}', '{$uemail}', '{$uname}', '{$upass}', '{$ugender}', '{$img_name}', '{$urole}');";
            // = "INSERT INTO user                                                                                                                                      values('null', '".$fname."', '".$lname."', '".$uemail.", '".$uname."', '".$upass."', '".$ugender."', '".$img_name."', '".$urole."') ";
            $ad = mysqli_query($con,$add_user) or die(mysqli_error($con));
            if ($ad)
            {
                // header("Location:.php");
               echo "<script>$('.contactForm')[0].reset();</script>";
               $ex['err'] = "<div class='alert alert-success'><i class='fas fa-exclamation-circle'> </i> Congratulation! Registration has been SuccessFully.</div>";
            }
            else
            {
                $ex['err'] = "<div class='alert alert-danger'><i class='fas fa-exclamation-circle'></i>Sorry! There is mistake with Registration Form.</div>";

            }
        }
    }
}

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
    <script src="ShowUpload-img.js"></script>
<link rel="stylesheet" href="upload-img.css">
</head>
<body style="background-color: #efefef;">

<div class="container">
    
<div class="container mt-3">
<h2 class="h3 text-center">User Registration</h2>
<div class="row">
        <div class="col-md-2"></div>
        <br>
        <div class="col-md-8">    
            <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
                     <div><?php echo $ex['err'] ?></div>
                    <form method="post" class="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                    <!-- img upload  -->
                    <div class="row">
                        <div class="col-md-4"></div>
                    <div class="input-group col-md-4 text-center">
                        <div class="a">
                            <!-- <i class="fa fa-close close remove"></i> -->
                            <label class="imgdiv">
                                <img ID="impPrev" for="file" class="contactForm  rounded-circle  mx-auto d-block " src="admin/upload-img/user.png" />
                                <input type="file" name="image" id="file" class="inputfile text-center" onchange="ShowPreview(this);" />
                                <!-- <span class="fa fa-upload textdown" aria-hidden="true" id="textch">Upload Image</span> -->
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    </div>
                <!-- ---------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="InputFirst">First Name</label>
                            <input type="text"  name="first_name" value="<?php echo $fname; ?>" class="contactForm form-control" id="InputFirst" placeholder="Enter First Name">
                        <div class="text-danger"><?php echo $ex['efname'];?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputLast">Last Name</label>
                            <input type="text"  name="last_name" value="<?php  echo $lname; ?>" class="contactForm form-control" id="InputLast" placeholder="Enter Last Name">
                        <div class="text-danger"><?php echo $ex['elname'];?></div>
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label for="InputUser">Email</label>
                            <input type="email"  name="email"  value="<?php  echo $uemail; ?>" class="contactForm form-control" id="InputUser" placeholder="Enter Email">
                        <div class="text-danger"><?php echo $ex['euemail'];?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputUser">User Name</label>
                            <input type="text"  name="user_name"  value="<?php  echo $uname; ?>" class="contactForm form-control" id="InputUser" placeholder="Enter User Name">
                        <div class="text-danger"><?php echo $ex['euname'];?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPass">Password</label>
                            <input type="password"  name="pass"  class="form-control" id="InputPass" placeholder="Enter Password">
                        <div class="text-danger"><?php echo $ex['eupass'];?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="g">Gender</label>
                            <select class="form-control" name="gender" id="g">
                                <option value="" selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        <div class="text-danger"><?php echo $ex['eugender'];?></div>
                        </div>
                        
                    <div class="form-group col-md-6">
                        <?php if (isset($_GET["userid"])) {?>
                            <input type="submit" class="btn btn-warning" name="updateUser" value="Update">
                            <a href="userList.php"  class="btn btn-danger" roll="button" >Cancel</a>
                        <div class="text-danger"><?php echo $ex['err'];?></div>
                        <?php } 
                        else{?>
                        <input type="submit" class="btn btn-primary " name="adduser" value="Register">
                        <div class="text-danger"><?php echo $errors['imgSize'];?></div>
                        <div class="text-danger"><?php echo $errors['ext'];?></div>

                        <?php }?>
                    </div>
                </div>
            </form> 
            </div>  
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</div>
</body>
</html>
<?php  # include("footer.php");
// ob_end_flush();
}?>
