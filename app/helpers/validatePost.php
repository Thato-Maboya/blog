<?php

function validatePost($post){
    $errors = array();

    // Validating the title
    if(empty($post['title'])){
        array_push($errors, "Title is required");
    }

    // Validating the body
    if(empty($post['body'])){
        array_push($errors, "Body is required");
    }

    // Validating the select Topic
    if(empty($post['topic_id'])){
        array_push($errors, "Please select a topic");
    }


    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost){
        if(isset($post['update-post']) && $existingPost['id'] != $post['id']){
            array_push($errors, "Post with that title already exists");
        }

        if(isset($post['add-post'])){
            array_push($errors, "Post with this title already exists");
        }
    }

    return $errors;
}
