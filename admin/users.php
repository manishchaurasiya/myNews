<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$users = mysqli_query($conn, "SELECT * FROM user Where role=2 ");

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $serialNumber = 0;
                        while ($row = mysqli_fetch_assoc($users)) {
                            $serialNumber++;
                            echo " <tr>
                                            <td class='id'>$serialNumber</td>
                                            <td>$row[first_name] $row[last_name]</td>
                                            <td>$row[email]</td>
                                            <td>$row[role]</td>
                                            <td class='edit'><a href='update-user.php?id=$row[user_id]'><i class='fa fa-edit'></i></a></td>
                                            <td class='delete'><a href='delete-user.php?id=$row[user_id]'><i class='fa fa-trash-o'></i></a></td>
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