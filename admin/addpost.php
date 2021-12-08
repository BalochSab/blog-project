<?php 
session_start();
if (isset($_SESSION["role"]) &  $_SESSION['role']=='Admin') {

$title = $disc = $category = "";

include("adminhead.php") ?>
<div class="container mt-3">
<h2 class="h3 text-center">Add New Post</h2>
<div class="row">
        <div class="col-md-3"></div>
        <br>
        <div class="col-md-6">    
                <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
                    
                    <form method="post" action="postserver.php" class="font-weight-bolder" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="InputTitle">Title</label>
                        <input type="text" value="<?php #echo $title?>"  name="post_title" class="form-control" id="InputTitle" placeholder="Enter Title">
                        <!-- <div class="text-danger"><?php #echo $ex['title'];?></div> -->
                    </div>
                    <div class="form-group">
                        <label for="InputDiscription">Discription</label>
                        <textarea  name="post_disc" value="<?php #echo $disc?>" class="form-control" rows="5"  id="InputDiscription" placeholder="Enter Discription"></textarea>
                        <!-- <div class="text-danger"><?php  #echo $ex['disc'];?></div> -->
                    </div>
                    <div class="form-group ">
                        <label for="InputCategory">Category</label>
                        <select  name="category" class="form-control custom-select" id="InputTitle" >
                            <option selected>Select Category</option>
                            <?php 
                                include "connect.php";
                                $upSelect = "SELECT * FROM category";
                                $upDb = mysqli_query($con, $upSelect) or die("Query Feil") ;
                                while($show = mysqli_fetch_assoc($upDb) ){
                                    if ($show["category_id"]==$category) {
                                        $select = "Selected";
                                    }else{
                                        $select = "";
                                    }
                                    echo "<option value='{$show["category_id"]}'>{$show['category_name']}</option>";
                                }
                            ?>
                        </select>
                    <!-- <div class="text-danger"><?php #echo $ex['cat'];?></div> -->

                    </div>
                    <div class="form-group">
                        <label for="InputImage">Post Image</label>
                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            <input type="file" name="img" required class="custom-file-input" id="inputGroupFile01">
                        </div>
                    
                    </div>
                    <button type="submit" class="btn btn-primary" name="post">Post</button>

                </form>
                        
                </div>  
            </div>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>

    <?php 
    include("adminfooter.php") ;
    // include "postserver.php";

}
else{
    header("Location:index.php");
    }?>
