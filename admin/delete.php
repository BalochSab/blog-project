<?php 
if (isset($_GET["udelid"])) {
    $userId = $_GET["udelid"];
    require("connect.php");
    $delete_data = mysqli_query($con,"DELETE FROM user WHERE user_id = $userId");
    header("Location:userList.php");
}
if (isset($_GET["cdelid"])) {
    $catId = $_GET["cdelid"];
    require("connect.php");
    $delete_data = mysqli_query($con,"DELETE FROM category WHERE category_id = $catId");
    header("Location:categoryList.php");
}
if (isset($_GET["pdelid"])) {
    $postId = $_GET["pdelid"];
    require("connect.php");
    $delcat = "SELECT fk_category_id as cat,img FROM post WHERE post_id = $postId";
    $delconfirmCat = mysqli_query($con,$delcat);
    $findpost = mysqli_fetch_assoc($delconfirmCat);
    if ($findpost) {
        unlink("upload-img/".$findpost["img"]);
        
        $delpost = "UPDATE category SET num_of_post = num_of_post-1 WHERE category_id = {$findpost["cat"]}; ";
        $delpost .= "DELETE FROM post WHERE post_id = $postId";
        mysqli_multi_query($con,$delpost) or die(include("Location:postlist.php"));

        header("Location:postlist.php");
    } 
    
}

?>