<!-- Including the global path -->
<?php
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$posts = '';
$postsTitle = 'Recent Posts';

// Verify the user using token
if (isset($_GET['verification_id'])){
    $verification_id = $_GET['verification_id'];
    verifyUser($verification_id);
}

// verify user by token
function verifyUser($verification_id){
    global $conn;
    $table = 'users';

    $sql = "SELECT * FROM $table WHERE id='$verification_id' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $update_query = "UPDATE $table SET verified=1 Where id='$verification_id'";
        if (mysqli_query($conn, $update_query)){
            // log user in
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = 1;
            // set Flash message
            $_SESSION['message'] = "Your email address was successfully verified!";
            $_SESSION['type'] = "success";
            header('location: '. BASE_URL . '/login.php');
            exit();
        }
    }
}


if(isset($_GET['t_id'])){
    $postsTitle = "You searched for posts under '" . $_GET['name']. "' ";
    $posts = getPostsByTopicId($_GET['t_id']);
} elseif(isset($_POST['search-term'])){
    $postsTitle = "You searched for '" . $_POST['search-term']. "' ";
    $posts = searchPosts($_POST['search-term']);
} else {
    $posts = getPublishedPosts();
}
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

    <title>Blog</title>
</head>
<body>

<!-- Including the header nav-bar -->
<?php include(ROOT_PATH . "/app/includes/header.php");?>
<?php include(ROOT_PATH . "/app/includes/messages.php");?>

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Carousel row slider -->
    <div class="post-slider">
        <h1 class="slider-title">Trending Post</h1>
        <i class="fa fa-chevron-left prev"></i>
        <i class="fa fa-chevron-right next"></i>

        <div class="post-wrapper">

            <?php foreach ($posts as $post): ?>

                <div class="post">
                    <img src="<?php echo BASE_URL . '/assets/images/'. $post['image']; ?>" alt="" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                        <i class="fa fa-user"><?php echo $post['username']; ?></i>
                        &nbsp;
                        <i class="fa fa-calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </div>
    <!-- // Carousel row slider -->


    <!--Content -->

    <div class="content clearfix">

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="recent-post-title"><?php echo $postsTitle; ?></h1>

            <?php foreach ($posts as $post): ?>

                <div class="post clearfix">
                    <img src="<?php echo BASE_URL . '/assets/images/'. $post['image']; ?>" alt="" class="post-image">
                    <div class="post-preview">
                        <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                        <i class="fa fa-user"><?php echo $post['username']; ?></i>
                        &nbsp;
                        <i class="fa fa-calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
                        <p class="preview-text">
                            <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
                        </p>
                        <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
        <!-- // Main Content -->

        <!-- Sidebar Content -->
        <div class="sidebar">

            <div class="section search">
                <h2 class="section-title">Search</h2>
                <form action="index.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>

            <div class="section topics">
                <h2 class="section-title">Topics</h2>
                <ul>
                    <!-- Including the topics -->
                    <?php foreach ($topics as $key => $topic): ?>
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