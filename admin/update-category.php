<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $update = mysqli_query($conn, "UPDATE category SET category_name='$_POST[name]' WHERE category_id=$_GET[id]");
    if ($update) {
        $msg = " Category Updated successfully!";
    } else {
        echo mysqli_error($conn);
    }
}

$categoryData = mysqli_query($conn, "SELECT * FROM category WHERE category_id=$_GET[id]");
$rows = mysqli_fetch_assoc($categoryData);
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Edit Category</h1>
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
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $rows['category_name'] ?>" placeholder="" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update Category" required />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>