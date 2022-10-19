<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                include "config.php";
                $id = $_GET["user_id"];
                $sql ="SELECT * FROM `user` WHERE `user_id`=$id ";
                $result =mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                
                ?>
                <form action="" method="POST">
                    <?php while ($row = mysqli_fetch_assoc($result)) {  ?> 
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $row["first_name"]; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $row["last_name"]; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row["username"]; ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                            <option value="0">normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <?php } ?>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php } ?>
                <!-- /Form -->
                <?php
                include "config.php";
                if(isset($_POST["submit"])){
                $user_fname = $_POST["f_name"];
                $user_lname = $_POST["l_name"];
                $user_name = $_POST["username"];
                $user_role = $_POST["role"];
                
                $query = "UPDATE `user` SET `first_name`='$user_fname',`last_name`='$user_lname',`username`='$user_name',`role`='$user_role' WHERE `user_id`=$id ";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    header("location:http://localhost/KJ/admin/users.php");
                }
            }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>