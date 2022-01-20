<?php include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$posts = mysqli_query($conn, "SELECT post.*,user.first_name,user.last_name,category.category_name from post,user,category where post.author=user.user_id and post.category=category.category_id");
?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $serialNumber = 0;
                        while ($rows = mysqli_fetch_assoc($posts)) {
                            $serialNumber++;
                            echo "<tr>
                                <td class='id'>$serialNumber</td>
                                <td>$rows[title]</td>
                                <td>$rows[category_name]</td>
                                <td>$rows[post_date]</td>
                                <td>$rows[first_name] $rows[last_name]</td>
                                <td class='edit'><a href='update-post.php?id=$rows[post_id]'><i class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-post.php?id=$rows[post_id]'><i class='fa fa-trash-o'></i></a></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>