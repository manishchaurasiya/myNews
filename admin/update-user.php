<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $update = mysqli_query($conn, "UPDATE user SET first_name='$_POST[fname]',last_name='$_POST[lname]',email='$_POST[email]',role='$_POST[role]' WHERE user_id=$_GET[id]");
    if ($update) {
        $msg = "Updated successfully!";
    } else {
        echo mysqli_error($conn);
    }
}

$userData = mysqli_query($conn, "SELECT * FROM user WHERE user_id=$_GET[id]");
$rows = mysqli_fetch_assoc($userData);
$roles = mysqli_query($conn, "SELECT * FROM roles");


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                if (isset($msg)) {
                    echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>{$msg}</strong>
                    </div>";
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="$_GET['id']" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $rows['first_name'] ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $rows['last_name'] ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $rows['email'] ?>" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option>Select User</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($roles)) {
                                if ($row['id'] == $rows['role']) {
                                    echo "<option value='$row[id]' selected> $row[role]</option>";
                                } else {
                                    echo "<option value='$row[id]'> $row[role]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>