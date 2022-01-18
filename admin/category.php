<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$categories = mysqli_query($conn, "SELECT * FROM category");
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                        $serialNumber = 0;
                        while ($rows = mysqli_fetch_assoc($categories)) {
                            $serialNumber++;
                            echo " <tr>
                                            <td class='id'>$serialNumber</td>
                                            <td style='text-align:center'>$rows[category_name]</td>
                                            <td class='edit'><a href='update-category.php?id=$rows[category_id]'><i class='fa fa-edit'></i></a></td>
                                            <td class='delete'><a href='delete-category.php?id=$rows[category_id]'><i class='fa fa-trash-o'></i></a></td>
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
