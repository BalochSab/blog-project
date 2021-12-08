<?php 
    include("admin/connect.php");
    $sql = "SELECT post_id,post_title,post_discription,post_date,img,user_id,user_name,category_id,category_name FROM post 
    LEFT JOIN category ON fk_category_id = category_id
LEFT JOIN user ON fk_user_id = user_id Where user_id = {$_GET["userIdpost"]} ORDER BY post_id desc";
    $sql_date = mysqli_query($con,$sql) or die("query field");
    if ($sql_date) {

    while ($show = mysqli_fetch_assoc($sql_date)) {
?>

        <div class="row no-gutters bg-light position-relative shadow p-1 mb-4 bg-white border-0">
            
            <div class="col-md-6 mb-md-0 p-md-3">
                <a href="index.php?postIdDetail=<?php echo $show["post_id"]?>" class="">
                    <img src="admin/upload-img/<?php echo $show["img"]?>" alt="" class=" img-thumbnail">
                </a>
            </div>
            <div class="col-md-6 position-static p-2 pl-md-0">
                <h5 class="mt-0"><a href="index.php?postIdDetail=<?php echo $show["post_id"]?>" class="text-dark"><?php echo $show["post_title"]?></a></h5>
                <div class="text-dark small ">
                    <span class="text-dark"><i class="far fa-calendar-alt text-primary"> </i> <?php $phpdate = strtotime( $show["post_date"] );
                    $mysqldate = date('d M, Y', $phpdate); echo $mysqldate?> </span>
                    <a href="index.php?categoryIdPost=<?php echo $show["category_id"]?>" class="text-dark"><i class="fas fa-tags text-primary"> </i> <?php echo $show["category_name"]?> </a>
                    <a href="index.php?userIdpost=<?php echo $show["user_id"]?>" class="text-dark"><i class="fas fa-user text-primary"> </i> <?php echo $show["user_name"]?> </a>
                </div>
                <p class="text-justify"><?php
                $string = strip_tags($show["post_discription"]);
                if (strlen($string) > 180) {
                
                    // truncate string
                    $stringCut = substr($string, 0, 180);
                    $endPoint = strrpos($stringCut, ' ');
                
                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $string .="...";
                }
                
                
                echo $string ;?></p>
                <a href="index.php?postIdDetail=<?php echo $show["post_id"]?>" class=" float-right">Read more..</a>
            </div>
        </div>
<?php }
         }?>


