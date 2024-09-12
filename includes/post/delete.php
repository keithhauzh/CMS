<?php
    //connect to database
        $database = connectToDB();

    //get data
        $id = $_POST['id'];

    //SQL to delete
        $sql = "DELETE FROM posts WHERE id = :id";
    
    //preparing
        $query = $database -> prepare($sql);

    //execute
        $query -> execute ([
            'id' => $id
        ]);

    //redirect
        header("Location: /manage-posts");
        exit;