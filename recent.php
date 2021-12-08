
<?php 
include("admin/connect.php");
$sqlrec = "SELECT post_id,post_title,post_date,img,user_id,user_name FROM post 
LEFT JOIN user ON fk_user_id = user_id ORDER By post_id DESC LIMIT 3";
$sql_rec = mysqli_query($con,$sqlrec) or die(mysqli_error($con));
if ($sql_rec) {
while ($recent = mysqli_fetch_assoc($sql_rec)) {
                    
?>

            <div class="card" >
                    <div class="card-body">
                    <a href="index.php?postIdDetail=<?php echo $recent["post_id"]?>" class="">
                        <img src="admin/upload-img/<?php echo $recent['img'];?>" alt="" class="p-1 float-left" style="width: 30%;height: 60px;">
                    
                        <h6 cl ass="card-title float-left"><?php echo $recent['post_title'];?></h6>
                        </a>
                        <div class="text-dark small ">
                            <span class="text-dark"><i class="far fa-calendar-alt text-primary"> </i> 
                                <?php $phpdate = strtotime( $recent["post_date"] );
                                $mysqldate = date('d M, Y', $phpdate); echo $mysqldate?> 
                            </span>
                            <a href="index.php?userIdpost=<?php echo $recent["user_id"]?>" class="text-dark">
                                <i class="fas fa-user text-primary"> </i> <?php echo $recent["user_name"]?> 
                            </a>
                            <a href="index.php?postIdDetail=<?php echo $recent["post_id"]?>" class="float-right">More..</a>
                        </div>
                        
                    </div>
            </div>
 <?php }
}?>