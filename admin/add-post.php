<?php include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$author = mysqli_query($conn, "SELECT user_id from user WHERE email= '$_SESSION[username]'");
while ($row = mysqli_fetch_assoc($author)) {
    $authorid = $row['user_id'];
}
$categories = mysqli_query($conn, "SELECT * from category");

if (isset($_POST['submit']) && isset($_FILES['fileToUpload'])) {
    $postDate = date("d-m-Y");
    $filetype = $_FILES['fileToUpload']['type'];
    $file = $_FILES['fileToUpload']['name'];
    if ($filetype != "image/jpg" && $filetype != "image/jpeg" && $filetype != "image/png") {
        $msg = "Sorry, only JPG, JPEG & PNG files are allowed.";
    } else {
        $movefilestatus = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "upload/" . $_FILES['fileToUpload']['name']);
        if ($movefilestatus) {
            $result = mysqli_query($conn, "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('$_POST[post_title]', '$_POST[postdesc]', '$_POST[category]', '$postDate', '$authorid', '$file')");
            if ($result) {
                $msg = "Post uploaded seccessfully!";
            } else {
                $msg = mysqli_connect_error($conn);
            }
        }
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <?php
                if (isset($msg)) {
                    echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>{$msg}</strong>
                    </div>";
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option value="" selected> Select Category</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($categories)) {
                                echo "<option value='$row[category_id]'> $row[category_name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>