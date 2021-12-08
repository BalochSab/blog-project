<?php 
session_start();
if (isset($_SESSION["role"])& $_SESSION['role']=='Admin') {
ob_start();
    include("adminhead.php");
    
    $fname = $lname = $uname = $upass = $urole = "";
    $ex = array('err'=>'', 'efname'=>'', 'elname'=>'', 'euname'=>'', 'eupass'=>'', 'eurole'=>'');

    if (isset($_GET["userid"])) {
        $user_update_id = $_GET["userid"];
        include("connect.php");
        $up_query = "SELECT * FROM user WHERE user_id = '".$user_update_id."'";
        $up_run = mysqli_query($con, $up_query);
        $updata = mysqli_fetch_array($up_run);
    
        if (isset($_POST["updateUser"])) {
           
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
            if (empty($_POST["user_role"])) {
                $ex['eurole'] = "Role is not seleted";
            }else{
                $urole = $_POST["user_role"];
            }
            if (!array_filter($ex)){
               
                $userUpdate_ins = "UPDATE user SET first_name='".$fname."',last_name ='".$lname."', user_name ='".$uname."',user_password='".$upass."',user_role='".$urole."' WHERE user_id= $user_update_id";
                 $run_ = mysqli_query($con,$userUpdate_ins) or die("there is update query error ");
                if (mysqli_query($con,$userUpdate_ins)){
                    header("location:userList.php");
                    }
                    else{
                        $ex['err'] = "Error adding user in database<br/>";
                        header("location:apdate.php?userid=".$user_update_id."");
                    }
            } else {
                $ex["er"] = "There is still an error";
            }
        }
    }
    
?>
<div class="container mt-3">
<h2 class="h3 text-center">Add New User</h2>
<div class="row">
        <div class="col-md-3"></div>
        <br>
        <div class="col-md-6">    
                <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
                    
                    <form method="post" action="" >
                    <div class="form-group ">
                        <label for="InputFirst">First Name</label>
                        <input type="text"  name="first_name" value="<?php echo $updata['first_name'];?>" class="form-control" id="InputFirst" placeholder="Enter First Name">
                    <div class="text-danger"><?php echo $ex['efname'];?></div>
                    </div>
                    <div class="form-group ">
                        <label for="InputLast">Last Name</label>
                        <input type="text"  name="last_name" value="<?php  echo  $updata['last_name']; ?>" class="form-control" id="InputLast" placeholder="Enter Last Name">
                    <div class="text-danger"><?php echo $ex['elname'];?></div>
                    </div>
                    <div class="form-group ">
                        <label for="InputUser">User Name</label>
                        <input type="text"  name="user_name"  value="<?php  echo  $updata['user_name']; ?>" class="form-control" id="InputUser" placeholder="Enter User Name">
                    <div class="text-danger"><?php echo $ex['euname'];?></div>
                    </div>
                    <div class="form-group ">
                        <label for="InputPass">Password</label>
                        <input type="password"  name="pass" value="<?php  echo $updata['user_password']; ?>" class="form-control" id="InputPass" placeholder="Enter Password">
                    <div class="text-danger"><?php echo $ex['eupass'];?></div>
                    </div>
                    <div class="form-group ">
                        <label for="InputRole">User Role</label>
                        <select  name="user_role" class="form-control custom-select" id="InputRole" >
                            <option value="" disabled selected >Select User Role</option>
                            <option <?php if($updata["user_role"]=='Admin') {echo "selected";}?> value="Admin">Admin</option>
                            <option <?php if($updata["user_role"]=='User') {echo "selected";}?> value="User">User</option>
                        </select>
                        <div class="text-danger"><?php echo $ex['eurole'];?></div>
                    </div>
                        <input type="submit" class="btn btn-warning" name="updateUser" value="Update">
                        <a href="userList.php"  class="btn btn-danger" roll="button" >Cancel</a>
                    <div class="text-danger"><?php echo $ex['err'];?></div>
                </form> 
                </div>  
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php include("adminfooter.php");
ob_end_flush();
}else{
    header("Location:index.php");}?>
