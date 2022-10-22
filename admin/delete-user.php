<?php
include "config.php" ;
 $id = $_GET["user_id"] ;

 $sql ="DELETE FROM `user` WHERE `user_id`=$id ";
 $result =mysqli_query($conn,$sql);
 if($result){
    header("location:http://localhost/KJ/admin/users.php");
 }
?>