<?php 
session_start();
if (isset($_SESSION["role"]) & $_SESSION['role']=='Admin') {
    
    include("adminhead.php");?>
<div class="container">
<br>
<div class="row mb-2">
    <div class="col-md-12">
        <span class="float-light h2">All Posts</span>
        <a href="addpost.php" class="float-right btn-primary btn shadow-2 rounded-0" role="button">Add Post</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>S.NO</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>
                    <th>DATE</th>
                    <th>AUTHOR</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                include("connect.php");
                 //Pagination variable
                        $limit = 7;  
                        
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }else{
                            $page = 1;
                        }
                        $offset = ($page-1)*$limit;   // 
                $postQuiryJoin = "SELECT post_id,post_title,post_date,category_name,user_name FROM post 
                                    join category on fk_category_id=category_id 
                                    left join user on fk_user_id = user_id 
                                    ORDER BY post_id DESC LIMIT {$offset},{$limit}";
                $allpost = mysqli_query($con,$postQuiryJoin);
                while ($show = mysqli_fetch_assoc($allpost)) {
                    $phpdate = strtotime( $show["post_date"] );
                    $mysqldate = date('d M, Y', $phpdate);
                    
            ?>
                <tr class="text-center"> 
                    <td><?php echo $show["post_id"]?></td>
                    <td class="text-left"><?php echo $show["post_title"]?></td>
                    <td><?php echo $show["category_name"]?></td>
                    <td><?php echo $mysqldate ?></td>
                    <td><?php echo $show["user_name"]?></td>
                    <td><a href="update-post.php?id=<?php echo $show["post_id"];?>" ><i class="fas fa-pen-alt"></i></a> </td>
                    <td><a href="delete.php?pdelid=<?php echo $show["post_id"]; ?>" onclick="return confirm('Are you Sure?')"><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php  }?>
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
                echo '<li class="page-item"><a class="page-link" href="postlist.php?page='.($page - 1).'">Prev</a></li>';
                }
                for ($i=1; $i <= $total_page ; $i++) { 
                    if ($i == $page) {
                        $active = "active";
                    }else {
                        $active = "";
                    }
                    echo '<li class="page-item '.$active.'"><a class="page-link" href="postlist.php?page='.$i.'">'.$i.'</a></li>';
                }
                if ($total_page > $page) {
                    echo '<li class="page-item"><a class="page-link" href="postlist.php?page='.($page + 1).'">Next</a></li>';
                }
                echo "</ul>";
            } ?>
    </div>
</div>



</div>
<?php  include("adminfooter.php");

}else{
    header("Location:index.php");}?>