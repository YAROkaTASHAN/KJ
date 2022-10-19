<?php
include "config.php" ;
 $id = $_GET["post_id"] ;

 $sql ="DELETE FROM `post` WHERE `post_id`=$id ";
 $result =mysqli_query($conn,$sql);
 if($result){
    header("location:http://localhost/KJ/admin/products.php");
 }
?>