<?php
if (isset($_FILES['img'])) {
    $errors = array();
    $img_name = $_FILES['img']['name'];
    $img_size = $_FILES['img']['size'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $img_type = $_FILES['img']['type'];

    $img_ext =  end(explode('.',$img_name));
    $extensions = array("jpeg","jpg","png");

    if (in_array($img_ext,$extensions) === false) {
        $errors[] = "This extension file not allowed, Please choose a JPG or PNG file";
    }
    
    if ($img_size > 2097152) {
        $ex['imgSize'] = "File size must be 2MB or lower ";
    }
    
    if (empty($errors) == true ) {
        move_uploaded_file($img_tmp,"upload-img/". $img_name) ;//or die("file not uploaded");
    }else {
       print_r($errors);
       die();
    } 
}else{
    $img_name = 'user.png';
}
    session_start();
    include "connect.php";

    $title = mysqli_real_escape_string($con,$_POST["post_title"]) ;
    $disc = mysqli_real_escape_string($con,$_POST["post_disc"]);
    $category = $_POST["category"];
    $date = date('Y-m-d H:i:s');//date("jS \of F Y ") ;//date("D M j G:i:s T Y"); 
    $auther = $_SESSION["user_id"];
    // (post_title,post_disccription,post_date,img,fk_category_id,fk_user_id)
    $insert_post = "INSERT INTO post value('null','{$title}','{$disc}','{$date}','{$img_name}',{$category},{$auther});";
    $insert_post .= "UPDATE category SET num_of_post = num_of_post+1 WHERE category_id = {$category} ";
    $inspost = mysqli_multi_query($con, $insert_post) or die("mulipule quiry field");
    
    if ($inspost)
    {
        header("Location:postlist.php");

    }
    else
    {
        $ex['err'] = "Error adding user in database<br/>";
    }

?>