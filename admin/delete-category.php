<?php
include "config.php" ;
 $id = $_GET["category_id"] ;

 $sql ="DELETE FROM `category` WHERE `category_id`=$id ";
 $result =mysqli_query($conn,$sql);
 if($result){
    header("location:http://localhost/KJ/admin/category.php");
 }
?>