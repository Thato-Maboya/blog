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

    <title>Admin Section - Add Users</title>
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
            <li><a href="index.php">Manage Users</a></li>
            <li><a href="../topics/index.php">Manage Topics</a></li>
        </ul>
    </div>
    <!-- // Left Sidebar -->

    <!-- Admin Content -->
    <div class="admin-content">
        <div class="button-group">
            <a href="create.php" class="btn btn-big">Add User</a>
            <a href="index.php" class="btn btn-big">Manage Users</a>
        </div>

        <div class="content">

            <h2 class="page-title">Add User</h2>

            <form action="create.php" method="post">
                <div>
                    <label for="">Username</label>
                    <input type="text" name="username" class="text-input">
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="email" name="email" class="text-input">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" class="text-input">
                </div>
                <div>
                    <label for="">Password Confirmation</label>
                    <input type="password" name="passwordConf" class="text-input">
                </div>
                <div>
                    <label>Role</label>
                    <select name="topic" class="text-input">
                        <option value="Poetry">Author</option>
                        <option value="Life Lessons">Admin</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-big">Add User</button>
                </div>
            </form>

        </div>

    </div>
    <!-- // Admin Content -->

</div>
<!-- // Admin Page wrapper -->



<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<!-- Custom Script -->
<script src="../../assets/js/script.js"></script>
</body>
</html>