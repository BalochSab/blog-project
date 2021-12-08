<?php
session_start();
if (isset($_SESSION["role"]) & $_SESSION['role']=='Admin') {
include("adminhead.php");
$err = "";
$catdata = "";

if (isset($_POST["add_category"])) {
    $gname = $_POST["name"];
    $con = mysqli_connect("localhost","root","","news");
    if (empty($gname)) {
         $err = "Must Enter Category Name Please";
    }else
    {   
        $qSelect = "SELECT * FROM category WHERE category_name= '".$gname."'";
        $check = mysqli_query($con, $qSelect);
        $data = mysqli_fetch_array($check, MYSQLI_NUM);
        if ($data[0]>1) {
            echo "Category Already in Exists<br/>";
        }
        else{
            $newCat="INSERT INTO category values('null','".$gname."',0)";
            if (mysqli_query($con,$newCat))
            {
                header("Location:categorylist.php");
            }
            else
            {
                $err = "Error adding user in database<br/>";
            }
        }
    }
}
if (isset($_GET["catupid"])) {
    $catupid = $_GET["catupid"];
    $con = mysqli_connect("localhost","root","","news") or die("no database Connection");
    $upSelect = "SELECT * FROM category WHERE category_id= '".$catupid."' ";
    $upDb = mysqli_query($con, $upSelect)  ;
    $catdata = mysqli_fetch_assoc($upDb) ;

    if (isset($_POST["updatecategory"])) {
        $catname = $_POST["name"];
        if (empty($catname)) {
            $err = "Must Enter Category Name Please";
       }else
       {   
           
           
               $upCat= "UPDATE category SET category_name='".$catname ."' WHERE category_id= '".$catupid."'";
               if (mysqli_query($con,$upCat))
               {
                   header("Location:categorylist.php");
               }
               else
               {
                   $err = "Error adding user in database<br/>";
               }
       }
    }
    
}

?>
<div class="container mt-3">
<h2 class="h3 text-center">Add New Category</h2>
<div class="row">
        <div class="col-md-3"></div>
        <br>
        <div class="col-md-6">    
                <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
                    
                        <form method="post" class="font-weight-bolder" >
                        <div class="form-group ">
                            <label for="Inputcategory">Category Name</label>
                            <input type="text"  name="name" value="<?php echo (isset($_GET["catupid"])) ? $catdata["category_name"] : '' ; ?>" class="form-control" id="Inputcategory" placeholder="Enter Category">
                            <div class="text-danger"><?php echo $err; ?></div> 
                        </div>
                        <?php if (isset($_GET["catupid"])) {?>
                            <input type="submit" class="btn btn-warning" name="updatecategory" value="Update">
                            <a href="categorylist.php"  class="btn btn-danger" roll="button" >Cancel</a>
                        <?php } else{?>

                        <button type="submit" class="btn btn-primary" name="add_category">Save</button>
                        <?php }?>
                    </form>
                        
                </div>  
            </div>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>

<?php include("adminfooter.php");
}else{
    header("Location:index.php");}?>
