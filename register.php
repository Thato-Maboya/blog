<!-- Including the global path -->
<?php include("path.php");?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();
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

    <title>Register</title>
</head>
<body>

<!-- Including the header nav-bar -->
<?php include(ROOT_PATH . "/app/includes/header.php");?>

<div class="auth-content">

    <form action="register.php" method="post">
        <h2 class="form-title">Register</h2>

        <!-- Displaying Error message is there is any error -->
        <?php include(ROOT_PATH . "/app/helpers/formErrors.php");?>


        <div>
            <label for="">Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
        </div>
        <div>
            <label for="">Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
        </div>
        <div>
            <label for="">Password Confirmation</label>
            <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
        </div>
        <div>
            <button type="submit" name="register-btn" class="btn btn-big">Register</button>
        </div>
        <p>Or <a href="<?php echo BASE_URL . '/login.php' ?>">Sign In</a></p>

    </form>

</div>


<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<!-- Custom Script -->
<script src="assets/js/script.js"></script>
</body>
</html>