<?php 
include 'header.php';
include "admin/conn.php";
$authors = mysqli_query($conn, "SELECT post.*,user.first_name,user.last_name,category.category_name from post,user,category where post.author=user.user_id and post.category=category.category_id and author = '$_GET[id]'");
$author = mysqli_query($conn,"SELECT first_name,last_name FROM user WHERE user_id='$_GET[id]'"); 
$auth = mysqli_fetch_assoc($author);
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $auth['first_name']." ". $auth['last_name'] ?></h2>
                  <?php
                    while($row = mysqli_fetch_assoc($authors))
                    {?>
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
                  ?>
                    
                    <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
