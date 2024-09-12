<?php

    //connect to database
        $database = connectToDB();

    //get all the data from the form
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $id = $_POST['id'];

    //check for error
        if ( empty($title) || empty($content) ) {
            setError( "Please fill in all fields!", '/manage-posts-edit' );
        } else {
            // update post data
                $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id";

            // prepare
                $query = $database -> prepare ($sql);

            // execute
                $query -> execute ([
                    'title' => $title,
                    'content' => $content,
                    'status' => $status,
                    'id' => $id
                ]);
        }

    //redirect
        header("Location: /manage-posts");
        exit;