<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$delete = mysqli_query($conn, "DELETE FROM category WHERE category_id =$_GET[id]");
if (!$delete) {
    echo mysqli_error($conn);
} else {
    header("location:category.php");
}
