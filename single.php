<?php include 'header.php';
include('admin/conn.php');
$posts = mysqli_query($conn, "SELECT post.*,user.first_name,user.last_name,category.category_name from post,user,category where post.author=user.user_id and post.category=category.category_id and post_id = '$_GET[id]'");
$data = mysqli_fetch_assoc($posts);

?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <div class="post-content single-post">
                        <h3><?php echo $data['title']; ?></h3>
                        <div class="post-information">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <?php echo $data['category_name']; ?>
                            </span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href="author.php?id=<?php echo $data['author'] ?>"><?php echo $data['first_name'] ?></a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo $data['post_date'] ?>
                            </span>
                        </div>
                        <img class="single-feature-image" src="admin/upload/<?php echo $data['post_img'] ?>">
                        <p class="description">
                            <?php echo $data['description'] ?>
                        </p>
                    </div>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>

<?php

$categoryIds =mysqli_query($conn,"SELECT category FROM post WHERE post_id='$_GET[id]'");
$categoryId = mysqli_fetch_assoc($categoryIds);

$relatedPosts = mysqli_query($conn, "SELECT post.*,user.first_name,user.last_name,category.category_name from post,user,category where post.author=user.user_id and post.category=category.category_id and post.category='$categoryId[category]' and post.post_id != '$_GET[id]' order by post.post_date DESC LIMIT 2");
?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if(mysqli_num_rows($relatedPosts)>0){
                        while ($row = mysqli_fetch_assoc($relatedPosts)) { ?>
                        
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt="" /></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href="category.php?id=<?php echo $row['category'] ?>"><?php echo $row['category_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href="author.php?id=<?php echo $row['author'] ?>"><?php echo $row['first_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo $row['description'] ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }else{
                    echo "<h2>No related post</h2>";
                }
                    ?>
                </div><!-- /post-container -->
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>