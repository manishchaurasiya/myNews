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
                                    <a href="author.php?id=<?php echo $data['author']?>"><?php echo $data['first_name']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $data['post_date']?>
                                </span>
                            </div>
                            <img  class="single-feature-image" src="admin/upload/<?php echo $data['post_img']?>">
                            <p class="description">
                               <?php echo $data['description']?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
