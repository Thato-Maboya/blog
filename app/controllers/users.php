<!-- Getting the information when the user clicks submit-btn -->
<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");
require_once 'emailController.php';

$table = 'users';

//Fetching all the admin users
$admin_users = selectAll($table);

/* Defining empty strings $ array */
$errors = array();
$id = '';
$username = '';
$admin = '';
$email = '';
$password = '';
$passwordConf = '';

function loginUser($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email']; // Sending email
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['verified'] = $user['verified']; // checking if user verified their email

    if ($user['verified'] == 0 ) {
        $_SESSION['message'] = "You are now signed up! <br> You need to verify your account. Sign in to your email account and click on the
                        verification link we just emailed you at <strong>" . $_SESSION['email'] . "</strong> before you sign in";
        $_SESSION['type'] = "success";
        sendVerificationEmail($_SESSION['email'], $_SESSION['id']); // Sending email
    }


    // To make uadmin to access the home(index.php) page we have to disable the if-else statement
    /*
    if ($_SESSION['admin']){
        header('location: '. BASE_URL . '/dashboard.php');
    } else
    */
    {
        header('location: '. BASE_URL . '/index.php');
    }
    exit();
}

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])){

    $errors = validateUser($_POST);


    if ((count($errors) === 0)){
        /* Removing the register-btn & passwordConf values using unset() from Register.php since in our DB we don't have them */
        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        /* Hashing the password in case the DB is hacked/compromised */
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if(isset($_POST['admin'])){
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = "Admin user created successfully";
            $_SESSION['type'] = "success";
            header('location: '. BASE_URL . '/usersIndex.php');
            exit();
        } else{
            /* Adding admin that takes value of false(0) when registering by default */
            $_POST['admin'] = 0;
            /* Outputting the data in the form of readable array */

            /* Calling the create() under "db.php" & assign it to "user_id" to INSERT the user */
            $user_id = create($table, $_POST);
            /* Calling the selectOne() under "db.php" & assign it to "user" to SELECT the user INFO/DATA */
            $user = selectOne($table, ['id' => $user_id]);

            /* Returning the result using the id after registering a user in the DB  */
            //dd($user);

            // Log user in immediately after creating account "Registering"
            loginUser($user);
        }

    } else{
        /* If there where errors we store the values that the user enters to save time for user while registering  */
        $username = $_POST['username'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}

if(isset($_POST['update-user'])){
    adminOnly();
    $errors = validateUser($_POST);

    if ((count($errors) === 0)){
        $id = $_POST['id'];
        unset($_POST['id'], $_POST['passwordConf'], $_POST['update-user']);
        /* Hashing the password in case the DB is hacked/compromised */
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $count = update($table, $id, $_POST);
        $_SESSION['message'] = "Admin user updated successfully";
        $_SESSION['type'] = "success";
        header('location: '. BASE_URL . '/usersIndex.php');
        exit();

    } else{
        /* If there where errors we store the values that the user enters to save time for user while registering  */
        $username = $_POST['username'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}

if (isset($_GET['id'])){
    $user = selectOne($table, ['id' => $_GET['id']]);

    $id = $user['id'];
    $username = $user['username'];
    $admin = $user['admin'];
    $email = $user['email'];
}


if (isset($_POST['login-btn'])){
    $errors = validateLogin($_POST);

    if ((count($errors) === 0)){
        $user = selectOne($table, ['username' => $_POST['username']]);

        if($user && password_verify($_POST['password'], $user['password'])){
            // Login redirect
            loginUser($user);
        } else{
            array_push($errors, "Wrong credentials");
        }
    }

    /* If there where errors we store the values that the user enters to save time for user while registering  */
    $username = $_POST['username'];
    $password = $_POST['password'];

}

if(isset($_GET['delete_id'])){
    adminOnly();
    $count = delete($table, $_GET['delete_id']);

    $_SESSION['message'] = "Admin user deleted successfully";
    $_SESSION['type'] = "success";
    header('location: '. BASE_URL . '/usersIndex.php');
    exit();
}


// if user clicks on the forgot password button
if (isset($_POST['forgot-password'])){
    global $conn;
    $email = $_POST['email'];

    if(empty($email)){
        array_push($errors, "Email required");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email address is invalid");
    }

    $existingUser = selectOne($table, ['email' => $email]);
    if ($existingUser){

        sendPasswordResetLink($existingUser['email'], $existingUser['id']);
        $_SESSION['message'] = "An email has been sent to your email address with a link to reset your password.";
        $_SESSION['type'] = "success";
        header('location: '. BASE_URL . '/login.php');
        exit(0);
    } else{
        array_push($errors, "Email address does not exist in our database");
    }
}

//if user clicks on the reset password button
if (isset($_POST['reset-password-btn'])){

    if(empty($_POST['password']) || empty($_POST['passwordConf'])){
        array_push($errors, "Password required");
    }
    if($_POST['password'] !== $_POST['passwordConf']){
        array_push($errors, "Passwords do not match");
    }
    unset($_POST['reset-password-btn'], $_POST['passwordConf']);
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //$sql = "UPDATE $table SET  id=".$_POST['id'].", admin=".$_POST['admin'].", username=".$_POST['username'].", email=".$_POST['email'].", verified=".$_POST['verified'].", password=".$_POST['password']."  WHERE id=".$_POST['id']." ";
    // prepare and bind
    $stmt = $conn -> prepare("UPDATE users SET admin=?, username=?, email=?, verified=?,password=? WHERE id=".$_POST['id']."");
    $stmt -> bind_param("sssss", $admin, $username, $email, $verified, $password);

    // set parameters and execute
    $admin = $_POST['admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $verified = $_POST['verified'];
    $password = $_POST['password'];

    $stmt -> execute();

    if ($stmt) {
        $_SESSION['message'] = "Your password was reset successfully you can now log in";
        $_SESSION['type'] = "success";
        header('location: '. BASE_URL . '/login.php');
        exit(0);
    } else {
        array_push($errors, "Update failed");
    }
    $conn->close();

}




