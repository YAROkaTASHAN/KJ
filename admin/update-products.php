<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Products</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php
                include "config.php";
                $id = $_GET["post_id"];
                $sql = "SELECT * FROM `post` WHERE `post_id`=$id ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {

                ?>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <?php while ($row = mysqli_fetch_assoc($result)) {  ?>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="products_title" class="form-control" id="exampleInputUsername" value="<?php echo $row["title"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="productsdesc" class="form-control" required rows="5"><?php echo $row["description"]; ?>
                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select name="category" class="form-control">
                                    <option value="" disabled> Select Category</option>
                                    <?php
                                    include "config.php";
                                    $query = "SELECT * FROM `category` ";
                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">UPLOADED-IMAGE</label>
                                <img src="upload/<?php echo $row["post_img"] ?>" height="150px">
                                </div>
                                <div class="form-group">
                                <label for="">RECENTLY-Product-image</label>
                                <input type="file" name="new-image" id="new-image">
                                <script>
                                var img = document.getElementById("new-image");
                                </script>
                                <img src="<script>upload/document.write(img)</script>" alt="">
                                <img src="upload/<?php echo $file_name1 ;?>" alt="">
                            </div>
                        <?php } ?>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                <?php } ?>
                <!-- Form End -->
                <?php
                $file_name1 = $_FILES["new-image"]["name"];
                if (isset($_POST["submit"])) {
                    error_reporting(E_ALL ^ E_WARNING);
                    include "config.php"; 
                    $title = $_POST["products_title"];
                    $discription = $_POST["productsdesc"];
                    $category = $_POST["category"];
                    $date = date("d - M - Y");
                    $author = $_SESSION["username"];
                    $error = [];
                    $file_name = $_FILES["new-image"]["name"];
                    $file_size = $_FILES["new-image"]["size"];
                    $file_type = $_FILES["new-image"]["type"];
                    $file_temp = $_FILES["new-image"]["tmp_name"];
                    $file_ext =  explode(".", "$file_name");
                    $file_ext =  end($file_ext);
                    $file_ext =  strtolower($file_ext);
                    $extension = array("jpg", "jpeg", "jfif", "png");

                    if (in_array($file_ext, $extension) === false) {
                        $error[] = "file should be in jpeg ,jpg,png";
                    }
                    if ($file_size > 2097152) {
                        $error[] = "fiel should be lesss than 2mb";
                    }
                    if (empty($error) == true) {
                        move_uploaded_file($file_temp, "upload/" . $file_name);
                    }
                    $sql = "UPDATE `post` SET `title`='$title',`description`='$discription',`category`='$category',`post_date`='$date',`author`='$author',`post_img`='$file_name' WHERE `post_id`=$id";

                    mysqli_query($conn, $sql);
                };
                 header("location:localhost/KJ/admin/users.php");

                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>