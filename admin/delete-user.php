<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$delete = mysqli_query($conn, "DELETE FROM user WHERE user_id =$_GET[id]");
if (!$delete) {
    echo mysqli_error($conn);
} else {
    header("location:users.php");
}
