<?php

    // connection to database
    function connectToDB() {
        $host = "localhost";
        $database_name = "CMS";
        $database_user = "root";
        $database_password = "mysql";

        $database = new PDO (
        "mysql:host=$host;dbname=$database_name",
        $database_user, //username
        $database_password //password
        );

        return $database;
    }

    //set error message
    function setError( $message, $redirect ) {
        $_SESSION['error'] = $message;
        //redirect back to selected page
        header("Location: " . $redirect);
        exit;
    }

    //check if user is logged in
    function checkIfUserIsNotLoggedIn () {
            if ( !isset ( $_SESSION['loggeduser'])){
                header("Location: /login");
                exit;
        }
    }

    //check if current user is an admin or not
    function checkIfIsAdmin () {
            if ( isset ( $_SESSION['loggeduser'] ) 
            && 
            $_SESSION['loggeduser']['role'] !== 'admin') {
                header("Location: /dashboard");
                exit;
        }
    }

    //check if current user is an editor and admin or not
    function checkIfIsEditorAdmin () {
        if ( 
            (isset ($_SESSION['loggeduser']))
            &&
            ($_SESSION['loggeduser']['role'] !== 'editor') 
            &&
            ($_SESSION['loggeduser']['role'] !== 'admin')
        ) {
            header("Location: /dashboard");
            exit;
        }
    }

    
