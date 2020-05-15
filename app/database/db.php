<?php

session_start();

require("connect.php");

function dd($values){ //To be delete, is just for development
    echo "<pre>", print_r($values, true), "</pre>";
    die();
}



/* Avoiding a repetition because repetition of code is not a good practice */
//Hence we refactor this repetition code into a different function to just call it
function executeQuery($sql, $data){
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

/* This is selectAll function which use fetch_all() */
// Return Nested Array()
function selectAll($table, $conditions = []){
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)){
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else{
        // return records that match the conditions ...
        // $sql = "SELECT * FROM $table WHERE username='Thato' AND admin=1";
        $i = 0;
        foreach ($conditions as $key => $value){
            if ($i === 0){
                $sql = $sql . " WHERE $key=?";
            } else{
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

/* This is selectOne function which use fetch_assoc() & conditions are required */
/* NB this returns only Array() not nested Array e.g. Array( [0] => Array()...) */
function selectOne($table, $conditions){

    global $conn;
    $sql = "SELECT * FROM $table";

    $i = 0;
    foreach ($conditions as $key => $value){
        if ($i === 0){
            $sql = $sql . " WHERE $key=?";
        } else{
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    // $sql = "SELECT * FROM $table WHERE username='Thato' AND admin=1" LIMIT 1;
    $sql = $sql . " LIMIT 1";

    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}


function create($table, $data){
    global $conn;
    // sql = "INSERT INTO users SET username=?, admin=?, email=?, password=?"
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value){
        if ($i === 0){
            $sql = $sql . " $key=?";
        } else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data){
    global $conn;
    // sql = "UPDATE users SET username=?, admin=?, email=?, password=? WHERE id=?"
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value){
        if ($i === 0){
            $sql = $sql . " $key=?";
        } else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    dd($sql);
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;             //Return 1 if it is updated succesfully & -1 otherwise
}

function delete($table, $id){
    global $conn;
    // sql = "DELETE FROM users WHERE id=?"
    $sql = "DELETE FROM $table WHERE id=?";


    $stmt = executeQuery($sql, ['id' => $id]);  //Passinfg an associative array id
    return $stmt->affected_rows;                //Return 1 if it is deleted succesfully & -1 otherwise
}


function getPublishedPosts(){
    global  $conn;
    //SELECT * FROM posts WHERE published=1
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPostsByTopicId($topic_id){
    global  $conn;
    //SELECT * FROM posts WHERE published=1
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";

    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term){

    $match = '%' .$term. '%';
    global  $conn;
    //SELECT * FROM posts WHERE published=1
    $sql = "SELECT 
                p.*, u.username 
            FROM posts AS p 
            JOIN users AS u 
            ON p.user_id=u.id 
            WHERE p.published=?
            AND p.title LIKE ? OR p.body LIKE ?";

    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}