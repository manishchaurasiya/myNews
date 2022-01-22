<?php
include('admin/conn.php');
$data = mysqli_query($conn, "SELECT post.*,user.first_name,user.last_name,category.category_name from post,user,category where post.author=user.user_id and post.category=category.category_id order by post.post_date DESC LIMIT 5");

?>
<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="POST" autocomplete="off">
            <div class="input-group">
                <input type="text" name="search_data" class="form-control" placeholder="Search ....." required>
                <span class="input-group-btn">
                    <input type="submit" class="btn btn-danger" style="color:white;" name="search" value="SEARCH">
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        while ($recentPosts = mysqli_fetch_assoc($data)) { ?>
            <div class="recent-post">
                <a class="post-img" href="">
                    <img src="admin/upload/<?php echo $recentPosts['post_img'] ?>" alt="" />
                </a>
                <div class="post-content">
                    <h5><a href='single.php?id=<?php echo $recentPosts['post_id'] ?>'><?php echo $recentPosts['title'] ?></a></h5>
                    <span>
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <a href="category.php?id=<?php echo $recentPosts['category'] ?>"><?php echo $recentPosts['category_name'] ?></a>
                    </span>
                    <span>
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <?php echo $recentPosts['post_date'] ?>
                    </span>
                    <a class='read-more' href='single.php?id=<?php echo $recentPosts['post_id'] ?>'>read more</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- /recent posts box -->
</div>