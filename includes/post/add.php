<?php

//connect to database
$database = connectToDB();

//get all the data from the form 
$title = $_POST['title'];
$content = $_POST['content'];
$user_id = $_SESSION['loggeduser']['id'];

//check for error
if ( empty($title) || empty($content) ) {
    setError( "Please fill in all the fields!" , "/manage-posts-add" );
} else {
    // create posts
    $sql = "INSERT INTO posts (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)";

    //prepare
    $query = $database -> prepare($sql);

    //execute
    $query -> execute ([
        'title' => $title,
        'content' => $content,
        'user_id' => $user_id
    ]);
}

header("Location: /manage-posts");
exit;




