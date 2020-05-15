<!-- Including the global path -->
<?php include("path.php");?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- CSS link-->
    <link rel="stylesheet" href="style.css">

    <title>Password message</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div login">
            <p>
                An email has been sent to your email address with a link to reset your
                password.
            </p>
        </div>
    </div>
</div>

</body>
</html>
