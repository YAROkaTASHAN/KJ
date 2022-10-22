<?php
include "config.php" ;
 $id = $_GET["post_id"] ;
 $cid =$_GET["category_id"] ;
 echo $_GET["category_id"] ;
 $sql ="DELETE FROM `post` WHERE `post_id`= '{$id}';";
 $sql .="UPDATE `category` SET `post`=post - 1 WHERE `category_id` = '{$cid}';";
 mysqli_multi_query($conn,$sql);

    header("location:http://localhost:82/KJ/admin/products.php");
 
 ?>
 