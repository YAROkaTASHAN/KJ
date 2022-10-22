<?php include "header.php"; ?> 
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Products</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="products_title">Title</label>
                          <input type="text" name="products_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="productsdesc" class="form-control" rows="5"  required></textarea>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option value="" disabled> Select Category</option>
                              <?php 
                                include "config.php";
                                $query = "SELECT * FROM `category` ";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                    }
                                }
                                ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Product image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                  if(isset($_POST["submit"])){
                    error_reporting(E_ALL ^ E_WARNING); 
                    include "config.php";
                    $title =$_POST["products_title"];  
                    $discription =$_POST["productsdesc"];  
                    $category =$_POST["category"];  
                    $date =date("d - M - Y");  
                    $author =$_SESSION["username"];  
                    
                    $file_name =$_FILES["fileToUpload"]["name"];
                    $file_size=$_FILES["fileToUpload"]["size"];
                    $file_type =$_FILES["fileToUpload"]["type"];
                    $file_temp =$_FILES["fileToUpload"]["tmp_name"];
                    $file_ext=  explode(".","$file_name");
                    $file_ext=  end($file_ext);
                    $file_ext=  strtolower($file_ext);
                    $extension= array("jpg","jpeg","jfif","png");

                    if(in_array($file_ext,$extension) === false)
                    {  
                        $error[] = "file should be in jpeg ,jpg,png";
                    }
                    if($file_size > 2097152)
                    {
                        $error[] = "fiel should be lesss than 2mb";
                    }
                    if(empty($error)== true)
                    {
                        move_uploaded_file($file_temp,"upload/".$file_name);
                    }
                    
                    
                    $sql ="INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$title','$discription','$category','$date','$author','$file_name');";

                    $sql .="UPDATE `category` SET `post`=post + 1 WHERE `category_id` ='$category';";
                    mysqli_multi_query($conn,$sql);
                }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
