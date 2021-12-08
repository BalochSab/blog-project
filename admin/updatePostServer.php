<?php
if (isset($_FILES['img']['name'])) {
    $img_name = $_POST["old_img"];
}
else{
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
}
    include("connect.php");
    $title = mysqli_real_escape_string($con,$_POST["post_title"]) ;
    $disc = mysqli_real_escape_string($con,$_POST["post_disc"]);
    $category = $_POST["category"];
    $old_cat = $_POST["old_cat"];
    $update_post = "UPDATE post SET 
    post_title='{$_POST["post_title"]}',post_discription='{$_POST["post_disc"]}',img='{$img_name}',
    fk_category_id={$_POST["category"]} WHERE post_id = {$_POST["post_id"]};";
    
    if ($old_cat!=$category) {
        //add num_of_post with changed old to new
        $update_post .=  "UPDATE category SET num_of_post = num_of_post+1 WHERE category_id = {$category};";
        $update_post .=  "UPDATE category SET num_of_post = num_of_post-1 WHERE category_id = {$old_cat};";
    }
    
    $up_post = mysqli_multi_query($con, $update_post) or die("quiry field");
    
    if ($up_post)
    {
        header("Location:postlist.php");
    }
    else
    {
        $ex['err'] = "Error adding user in database<br/>";
    }

?>