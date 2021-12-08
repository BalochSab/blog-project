<?php include("head.php"); 
include("admin/connect.php");?>
<br>
<div class="container">
    
    <div class="row">
        <!-- start news list at home page -->
        <div class="col-md-8">
        <?php 
        if (isset($_GET["postIdDetail"])) {
            include("detail.php");
        }
        elseif (isset($_GET["categoryIdPost"])) {
            $catId = $_GET["categoryIdPost"];
            $sql = "SELECT category_name from category where category_id = $catId";
            $sql_date = mysqli_query($con,$sql) or die(mysqli_error($con));
            $cat = mysqli_fetch_array($sql_date);
            $retVal = ($cat>0) ? $cat[0] : "Sorry Not Found";
            echo "<div class='card row no-gutters bg-light position-relative shadow p-1 mb-4 bg-white border-0'>
                <div class='card-body border-bottom border-primary' style='border-width: 5px !important'>
                    <p class='h3'>User : $retVal </p>
                </div>
            </div>";
            include("Category.php");
        }
        elseif (isset($_GET["userIdpost"])) {
            $User = $_GET["userIdpost"];
            $sql = "SELECT user_name from user where user_id = $User";
            $sql_date = mysqli_query($con,$sql) or die(mysqli_error($con));
            $cat = mysqli_fetch_array($sql_date);
            $retVal = ($cat>0) ? $cat[0] : "There is no user";

            echo "<div class='card row no-gutters bg-light position-relative shadow p-1 mb-4 bg-white border-0'>
                <div class='card-body border-bottom border-primary' style='border-width: 5px !important'>
                    <p class='h3'>User : $retVal </p>
                </div>
            </div>";
           
            include("userpost.php");
        }
        elseif (isset($_GET["search"])) {
            echo '<div class="card row no-gutters bg-light position-relative shadow p-1 mb-4 bg-white border-0">
                <div class="card-body border-bottom border-primary" style="border-width: 5px !important">
                    <p class="h3">Searched : '.$_GET["search"].' </p>
                </div>
            </div>';
            include("search.php");
        }        
        elseif (isset($_GET["home"])) {
            include("home.php");
        }
        else {
            include("home.php");
        }
        
         ?>
         
        </div>
        <!-- end news list at home page -->
        <div class="col-md-4" >
            <!-- Search Card -->
            <div class="card shadow p-1 mb-4 bg-white border-0">
                <div class="card-body">
                    <h4 class="h4">Search</h4>
                   
                        <form action="" method="get" class="form-inline">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" name="search" id="" class="form-control" placeholder="Search" aria-describedby="helpId">
                                <input type="submit" name="btn_search" value="Search" class="form-control btn btn-primary" >
                            </div>
                        </form>
                </div>  
            </div>
            <hr>
            <!-- recent news -->
            <h2>Recently Post</h2>
            <?php 
            
            include("recent.php")
            
            ?>
        </div>
    </div>
</div>







<?php include("footer.php");?>