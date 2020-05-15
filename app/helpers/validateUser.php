<?php

function validateUser($user){
    $errors = array();

    // Validating the username
    if(empty($user['username'])){
        array_push($errors, "Username is required");
    }

    // Validating the email
    if(empty($user['email'])){
        array_push($errors, "Email is required");
    }

    // Validating the password
    if(empty($user['password'])){
        array_push($errors, "Password is required");
    }

    // Checking if the passwords match
    if($user['passwordConf'] !== $user['password']){
        array_push($errors, "Password do not match");
    }

    /* $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser){
        array_push($errors, "Email already exists");
    } */
    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser){
        if(isset($user['update-user']) && $existingUser['id'] != $user['id']){
            array_push($errors, "Email already exists");
        }

        if(isset($post['create-admin'])){
            array_push($errors, "Email already exists");
        }
    }

    return $errors;
}




function validateLogin($user){
    $errors = array();

    // Validating the username
    if(empty($user['username'])){
        array_push($errors, "Username is required");
    }

    // Validating the password
    if(empty($user['password'])){
        array_push($errors, "Password is required");
    }


    return $errors;
}
