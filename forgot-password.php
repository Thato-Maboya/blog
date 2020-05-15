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

    <title>Forget Password</title>
</head>
<body>

<!-- Including the header nav-bar -->
<?php include(ROOT_PATH . "/app/includes/header.php");?>

<div class="auth-content">

    <form action="forgot-password.php" method="post">

        <h3 class="form-title">Recover your password</h3>
        <p>
            Please enter your email address you used to sign up on this site
            and we will assist you in recovering yor password.
        </p>


        <!-- Displaying Error message is there is any error -->
        <?php include(ROOT_PATH . "/app/helpers/formErrors.php");?>

        <div>
            <label for="">Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
        </div>
        <div>
            <button type="submit" name="forgot-password" class="btn btn-big">Recover your password</button>
        </div>

    </form>

</div>


<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<!-- Custom Script -->
<script src="assets/js/script.js"></script>
</body>
</html>

