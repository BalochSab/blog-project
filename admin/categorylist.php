<?php 
session_start();
if (isset($_SESSION["role"]) & $_SESSION['role']=='Admin') {
include("adminhead.php");?>
<div class="container">
<br>
<div class="row mb-2">
    <div class="col-md-12">
        <span class="float-light h2">All Categories</span>
        <a href="addcategory.php" class="float-right btn-primary btn shadow-2 rounded-0" role="button">Add Category</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th>S.NO</th>
                    <th>CATEGORY NAME</th>
                    <th>NO. OF POSTS</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    require("connect.php");
                     //Pagination variable
                     $limit = 5;  
                     $i = 1;
                        
                     if (isset($_GET['page'])) {
                         $page = $_GET['page'];
                     }else{
                         $page = 1;
                     }
                     $offset = ($page-1)*$limit;   // 
                    $cat_data = mysqli_query($con,"SELECT * FROM category ORDER BY num_of_post DESC LIMIT {$offset},{$limit}");
                    
                    while ($show = mysqli_fetch_assoc($cat_data)) {
                        
                ?>
                <tr>
                    <td><?php echo $i #$show["category_id"] ?></td>
                    <td><?php echo $show["category_name"] ?></td>
                    <td><?php echo $show["num_of_post"] ?></td>
                    <td><a href="addcategory.php?catupid=<?php echo $show["category_id"];?>" ><i class="fas fa-pen-alt"></i></a> </td>
                    <td><a href="delete.php?cdelid=<?php echo $show["category_id"]; ?>" onclick="return confirm('Are you Sure?')"><i class="fas fa-trash"></i></a></td>
                </tr>
                    <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
    <?php //pagination get same table 
            $sql_page = "SELECT * FROM post";
            $resutl = mysqli_query($con,$sql_page) or die("Query Feiled");
            $row = mysqli_num_rows($resutl);
            if ($row > 0) {
                $total_records = $row;
                $total_page = ceil($total_records / $limit);
            
            echo '<ul class="pagination justify-content-center " style="text-align: center;">';
                if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="categorylist.php?page='.($page - 1).'">Prev</a></li>';
                }
                for ($i=1; $i <= $total_page ; $i++) { 
                    if ($i == $page) {
                        $active = "active";
                    }else {
                        $active = "";
                    }
                    echo '<li class="page-item '.$active.'"><a class="page-link" href="categorylist.php?page='.$i.'">'.$i.'</a></li>';
                }
                if ($total_page > $page) {
                    echo '<li class="page-item"><a class="page-link" href="categorylist.php?page='.($page + 1).'">Next</a></li>';
                }
                echo "</ul>";
            } ?>
    </div>
</div>



</div>
<?php include("adminfooter.php");
}else{
    header("Location:index.php");}?>