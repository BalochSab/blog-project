<?php 
    include("admin/connect.php");
    $sql = "SELECT post_id,post_title,post_discription,post_date,img,user_id,user_name,category_id,category_name FROM post 
    LEFT JOIN category ON fk_category_id = category_id
    LEFT JOIN user ON fk_user_id = user_id Where post_id = {$_GET["postIdDetail"]} ";
    $sql_date = mysqli_query($con,$sql) or die("query field");
    $show = mysqli_fetch_assoc($sql_date);
    if ($show > 0) {
?>

        
            <div class="card border-0  shadow p-1 mb-4 bg-white border-0" >
                    <div class="card-body">
                <h5 class="mt-0 card-title"><a href="index.php?postIdDetail=<?php echo $show["post_id"]?>" class="text-dark"><?php echo $show["post_title"]?></a></h5>
                       
                        <!-- <h5 class="card-title">Special title treatment</h5> -->
                        <div class="text-dark small ">
                    <span class="text-dark"><i class="far fa-calendar-alt text-primary"> </i> <?php $phpdate = strtotime( $show["post_date"] );
                    $mysqldate = date('d M, Y', $phpdate); echo $mysqldate?> </span>
                    <a href="index.php?categoryIdPost=<?php echo $show["category_id"]?>" class="text-dark"><i class="fas fa-tags text-primary"> </i> <?php echo $show["category_name"]?> </a>
                    <a href="index.php?userIdpost=<?php echo $show["user_id"]?>" class="text-dark"><i class="fas fa-user text-primary"> </i> <?php echo $show["user_name"]?> </a>
                </div>
                        <img src="admin/upload-img/<?php echo $show["img"]?>" alt="" class="float-center p-3" style="width:100%;height: 400px">
                        <p class="cart-text text-justify"><?php 
                        $sanitized = htmlspecialchars($show["post_discription"]);
                        echo str_replace(array("\r\n", "\n"), array("<br />", "<br />"), $sanitized);
                         ?></p>
                       
                    </div>
            </div>   
<?php }else {
    echo '<div class="card row no-gutters bg-light position-relative shadow p-1 mb-4 bg-white border-0">
    <div class="card-body ">
        <p class="h3"> No Record Found<p>
    </div>
</div>';
}


?>



        