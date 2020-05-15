<!-- Including the global path -->
<?php include("path.php");?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();

// Verify the user using token
if (isset($_GET['reset-password-id'])){
    $user = selectOne('users', ['id' => $_GET['reset-password-id']]);
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

    <title>Reset Password</title>
</head>
<body>

<br><br><br>
<div class="auth-content" >

    <form class="reset-password" action="reset-password.php" method="post">
        <h2 class="form-title">Reset your password</h2>

        <!-- Displaying Error message is there is any error -->
        <?php include(ROOT_PATH . "/app/helpers/formErrors.php");?>

        <input type="hidden" name="id" value="<?php echo $_GET['reset-password-id']; ?>">
        <?php if(isset($user['admin']) == 1): ?>
            <input type="hidden" name="admin" value="1">
        <?php else: ?>
            <input type="hidden" name="admin" value="0">
        <?php endif; ?>
        <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
        <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
        <?php if(isset($user['verified']) == 1): ?>
            <input type="hidden" name="verified" value="1">
        <?php else: ?>
            <input type="hidden" name="verified" value="0">
        <?php endif; ?>
        <div>
            <label for="">Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
        </div>
        <div>
            <label for="">Password Confirmation</label>
            <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
        </div>
        <div>
            <button type="submit" name="reset-password-btn" class="btn btn-big">Reset Password</button>
        </div>

    </form>

</div>


<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<!-- Custom Script -->
<script src="assets/js/script.js"></script>
</body>
</html>