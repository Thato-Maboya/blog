<?php include("../../path.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Admin Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <title>Admin Section - Edit Topic</title>
</head>
<body>

<header>
    <a class="logo" href="<?php echo BASE_URL . '/index.php' ?>">
        <h1 class="logo-text"><span>Thato</span>Inspires</h1>
    </a>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <li>
            <a href="#">
                <i class="fa fa-user"></i>
                Thato Maboya
                <i class="fa fa-chevron-down" style="font-size: 0.8em"></i>
            </a>
            <ul>
                <li><a href="#" CLASS="logout">Logout</a></li>
            </ul>
        </li>
    </ul>
</header>

<!-- Admin Page Wrapper -->
<div class="admin-wrapper">

    <!-- Left Sidebar -->
    <div class="left-sidebar">
        <ul>
            <li><a href="../posts/index.php">Manage Posts</a></li>
            <li><a href="../users/index.php">Manage Users</a></li>
            <li><a href="index.php">Manage Topics</a></li>
        </ul>
    </div>
    <!-- // Left Sidebar -->

    <!-- Admin Content -->
    <div class="admin-content">
        <div class="button-group">
            <a href="create.php" class="btn btn-big">Add Topics</a>
            <a href="index.php" class="btn btn-big">Manage Topics</a>
        </div>

        <div class="content">

            <h2 class="page-title">Edit Topics</h2>

            <form action="create.html" method="post">
                <div>
                    <label>Name</label>
                    <input type="text" name="name" class="text-input">
                </div>
                <div>
                    <label>Description</label>
                    <textarea name="description" id="body"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-big">Update Topic</button>
                </div>
            </form>

        </div>

    </div>
    <!-- // Admin Content -->

</div>
<!-- // Admin Page wrapper -->



<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<!-- CKeditor -->
<script src="../../ckeditor5/ckeditor.js"></script>
<!--/* What it does it "It look into the document & any element that has ad id=body, Replace
it with our reach text editor" */-->
<script>
    ClassicEditor.create( document.getElementById( "body" ));
</script>

<!-- Custom Script -->
<script src="../../assets/js/script.js"></script>
</body>
</html>