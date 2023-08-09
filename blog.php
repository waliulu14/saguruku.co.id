<?php
include 'include/config.php';
include 'include/navbar.php';

// Function to extract the YouTube video ID from the URL
function getYouTubeVideoId($url)
{
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query['v'];
}

$query = "SELECT * FROM carousel";
$result = mysqli_query($conn, $query);
$carousel_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch the "About Us" data from the database
$sql_about = "SELECT * FROM about_us";
$result_about = mysqli_query($conn, $sql_about);
$about_data = mysqli_fetch_assoc($result_about);

// Fetch the "Facts" data from the database
$sql_facts = "SELECT * FROM facts";
$result_facts = mysqli_query($conn, $sql_facts);
$facts_data = mysqli_fetch_all($result_facts, MYSQLI_ASSOC);

// Fetch the video URL from the "videos" table
$sql_videos = "SELECT * FROM videos";
$result_videos = mysqli_query($conn, $sql_videos);
$videos_data = mysqli_fetch_all($result_videos, MYSQLI_ASSOC);

$sql_blog_posts = "SELECT * FROM blog_details";
$result_blog_posts = mysqli_query($conn, $sql_blog_posts);
$blog_posts = mysqli_fetch_all($result_blog_posts, MYSQLI_ASSOC);
?>


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white animated slideInRight">Blog</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Blog Post Start -->
<div class="container py-5">
    <div class="row">
        <?php foreach ($blog_posts as $blog_post) : ?>
            <div class="col-md-4">
                <div class="blog-post">
                    <a href="<?php echo $blog_post['blog_link']; ?>">
                        <img class="img-fluid mb-4" src="blog/<?php echo $blog_post['image_url']; ?>" alt="">
                        <h2 class="mb-3"><?php echo $blog_post['title']; ?></h2>
                        <p><?php echo substr($blog_post['content'], 0, 100); ?>...</p>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Blog Post End -->


<?php include 'include/footer.php'; ?>



<style>
    /* Add your custom styles here */

    .blog-post {
        margin-bottom: 30px;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        background-color: #fff;
        transition: transform 0.3s ease;
    }

    .blog-post:hover {
        transform: scale(1.05);
    }

    .blog-post a {
        display: block;
        text-decoration: none;
        color: #333;
    }

    .blog-post img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .blog-post h2 {
        font-size: 20px;
        margin: 10px 0;
    }

    .blog-post p {
        font-size: 14px;
        line-height: 1.4;
    }
</style>
