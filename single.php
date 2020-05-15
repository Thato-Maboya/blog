<!-- Including the global path -->
<?php
include("path.php");
include(ROOT_PATH . "/app/controllers/posts.php");

if(isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);

}
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?php echo $post['title']; ?> | ThatoInspires</title>
</head>
<body>

<!-- Facebook Page Plugin SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0"></script>

<!-- Including the header nav-bar -->
<?php include(ROOT_PATH . "/app/includes/header.php");?>

<!-- Page Wrapper -->
<div class="page-wrapper">

    <!--Content -->

    <div class="content clearfix">

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <div class="main-content single">
                <h1 class="post-title"><?php echo $post['title']; ?></h1>

                <div class="post-content">
                    <?php echo html_entity_decode($post['body']); ?>
                </div>
            </div>
        </div>
        <!-- // Main Content Wrapper -->

        <!-- Sidebar Content -->
        <div class="sidebar single">

            <div class="fb-page" data-href="https://www.facebook.com/guestboys/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/guestboys/" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/guestboys/">Guest Boys</a>
                </blockquote>
            </div>

            <div class="section popular">
                <h2 class="section-title">Popular</h2>

                <?php foreach ($posts as $p): ?>

                    <div class="post clearfix">
                        <img src="<?php echo BASE_URL . '/assets/images/'. $p['image']; ?>" alt="">
                        <a href="" class="title"><h4><?php echo $p['title']; ?></h4></a>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="section topics">
                <h1 class="section-title">Topics</h1>
                <ul>

                    <?php foreach ($topics as $topic): ?>
                        <li><a href="<?php echo BASE_URL . '/index.php?t_id='. $topic['id'] . '&name=' . $topic['name'] ; ?>"><?php echo $topic['name']; ?></a></li>
                    <?php endforeach; ?>

                </ul>
            </div>

        </div>
        <!-- // Sidebar Content -->

    </div>

    <!--// Content -->

</div>
<!-- // Page wrapper -->

<!-- Including the footer -->
<?php include(ROOT_PATH . "/app/includes/footer.php");?>

<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<!-- Slick Carousel -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- Custom Script -->
<script src="assets/js/script.js"></script>
</body>
</html>