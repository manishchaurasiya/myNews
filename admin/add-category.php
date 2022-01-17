<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $categories = mysqli_query($conn, "SELECT category_name FROM category WHERE category_name='$category'");
    if ($categories) {
        $msg = "category already Exist";
    } else {
        $result = mysqli_query($conn, "INSERT INTO category(category_name) VALUES('$category')");
        if (!$result) {
            echo mysqli_error($conn);
        }
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <?php 
                if(isset($msg))
                {
                  echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>{$msg}</strong>
                    </div>";

                }
                ?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>