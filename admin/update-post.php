<?php include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$old_img = '';
$new_image = "";
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $postdesc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $postdesc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $old_img = mysqli_real_escape_string($conn, $_POST['old_image']);
    $new_image = mysqli_real_escape_string($conn, $_FILES['new_image']['name']);
    $movefilestatus = move_uploaded_file($_FILES['new_image']['tmp_name'], "upload/" . $_FILES['new_image']['name']);
    if ($_FILES['new_image']['name'] == "") {
        $update = mysqli_query($conn, "UPDATE post SET title='$title', description='$postdesc', category='$category', post_img='$old_img' WHERE post_id='$_GET[id]'");
        if ($update) {
            $msg = "Post uploaded seccessfully!";
        } else {
            $msg = mysqli_connect_error($conn);
        }
    }
    if ($movefilestatus  && $_FILES['new_image']['name'] !="") {
        $update = mysqli_query($conn, "UPDATE post SET title='$title', description='$postdesc', category='$category', post_img='$new_image' WHERE post_id='$_GET[id]'");
        if ($update) {
            $msg = "Post uploaded seccessfully!";
        } else {
            $msg = mysqli_connect_error($conn);
        }
    }
}
$postData = mysqli_query($conn, "SELECT * from post WHERE post_id='$_GET[id]'");
$row = mysqli_fetch_assoc($postData);
$categories = mysqli_query($conn, "SELECT * FROM category");
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <?php
                if (isset($msg)) {
                    echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>{$msg}</strong>
                    </div>";
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="post_id" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category">
                            <option value="">Select category</option>
                            <?php
                            while ($rows = mysqli_fetch_assoc($categories)) {
                                if ($rows['category_id'] == $row['category']) {
                                    echo "<option value='$rows[category_id]' selected> $rows[category_name]</option>";
                                } else {
                                    echo "<option value='$rows[category_id]'> $rows[category_name]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new_image">
                        <img src="upload/<?php echo $row['post_img'] ?>" height="150px">
                        <input type="hidden" name="old_image" value="<?php echo $row['post_img'] ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>