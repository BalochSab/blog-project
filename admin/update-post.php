<?php 
session_start();
if (isset($_SESSION["role"]) & $_SESSION['role']=='Admin') {
include("adminhead.php") ?>
<div class="container mt-3">
<h2 class="h3 text-center">Update Post</h2>
<div class="row">
        <!-- <div class="col-md-1"></div> -->
        <br>
        <div class="col-md-6">    
                <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
        <?php 
        include "connect.php";
        $post_id = $_GET['id'];
        $sqlselectquery = "SELECT post_id,post_title,category_id,post_discription,img FROM post 
        left join category on fk_category_id=category_id 
        left join user on fk_user_id = user_id WHERE post_id = $post_id";
        
        $update_run = mysqli_query($con, $sqlselectquery);
        if (mysqli_num_rows($update_run) > 0) {
            $show = mysqli_fetch_assoc($update_run)
        ?>
                    <form method="post" action="updatePostServer.php" class="font-weight-bolder" enctype="multipart/form-data">
                    <div class="form-group text-left">
                    <input type="hidden" name="post_id" value="<?php echo $show["post_id"];?>">
                        <label for="InputTitle">Title</label>
                        <input type="text" value="<?php echo $show["post_title"];?>"  name="post_title" class="form-control" id="InputTitle" placeholder="Enter Title">
                        
                    </div>
                    <div class="form-group">
                        <label for="InputDiscription">Discription</label>
                        <textarea  name="post_disc" class="form-control" rows="5"  id="InputDiscription" placeholder="Enter Discription"><?php echo $show["post_discription"]?></textarea>

                    </div>
                    <div class="form-group ">
                        <label for="InputCategory">Category</label>
                        <select  name="category" class="form-control custom-select" id="InputTitle" >
                            <option selected>Select Category</option>
                            <?php 
                                include "connect.php";
                                $upSelect = "SELECT * FROM category";
                                $upDb = mysqli_query($con, $upSelect) or die("Query Feil") ;
                                while($cat = mysqli_fetch_assoc($upDb)){
                                    if ($cat["category_id"]==$show["category_id"]) {
                                        $select = "Selected";
                                     
                                    }else{
                                        $select = "";
                                    }
                                    echo "<option {$select} value='{$cat["category_id"]}'>{$cat['category_name']}</option>";
                                }
                            ?>
                        </select>
                        <input type="hidden" name="old_cat" value="<?php echo $show["category_id"]?>">
                    </div>
                    <div class="form-group">
                        <label for="InputImage">Post Image</label>
                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            <input type="file" name="img" class="custom-file-input" id="inputGroupFile01">
                        </div>
                        <input type="hidden" name="old_img" value="<?php echo $show["img"]?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="post">Post</button>
                    <a href="postList.php" Class="btn btn-danger" role="button">Cancel</a>

                </form>
            
                        
                </div>  
            </div>
        </div>
        <div class="col-md-6">
        <div><img src="upload-img/<?php echo $show["img"]?>" alt="" style="width: 500px;height: 300px;"></div>
        </div>
        <?php   }?>
    </div>
</div>

    <?php 
    include("adminfooter.php") ;

}
else{
    header("Location:index.php");
    }?>
