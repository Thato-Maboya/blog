<?php

require 'app/database/db.php';
require_once 'emailController.php';

//Global array error message available into the whole authController code
// It is also available into signup.php since we included/required the autoCotnroller.php
$errors = array();
// When user click submit-btn we take values from the form and set them to this variables
//If there was an error on their form the value that they entered before will remains in the user
// variable so that the user does't have to enter the value again
$username = "";
$email = "";


// if user clicks on the forgot password button
if (isset($_POST['forgot-password'])){
    $email = $_POST['email'];

    if(empty($email)){
        $errors['email'] = 'Email required';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] == "Email address is invalid";
    }

    if (count($errors) == 0){
        $sql = " SELECT * FROM user3 WHERE email=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc($result);
        $token = $user['token'];

        sendPasswordResetLink($email, $token);
        header('location: password-message.php');
        exit(0);
    }
}

//if user clicks on the reset password button
if (isset($_POST['reset-password-btn'])){
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    if(empty($password) || empty($passwordConf)){
        $errors['password'] = 'Password required';
    }
    if($password !== $passwordConf){
        $errors['password'] = 'Passwords do not match';
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    if (count($errors) == 0){
        $sql = "UPDATE user3 SET password='$password' Where email='$email'";
        echo $sql;
        $result = mysqli_query($conn, $sql);

        if ($result){
            header('location: login.php');
            exit(0);
        }
    }
}



function resetPassword($token){
    global $conn;
    $sql = "SELECT * FROM user3 WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    header('location: reset-password.php');
    exit(0);

}

