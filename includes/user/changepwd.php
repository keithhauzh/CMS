<?php

    // 1. connect to database
        $database = connectToDB();

    // 2. get all the data from the form  using  $_POST
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $id = $_POST['id'];
    
    /* 
        3. do error checking 
        - all the fields are filled
        - password and confirm password is the same
    */
            if ( empty($password) || empty($confirm_password) ) {
                setError( "Please fill in all the fields", '/manage-users-changepwd?id=' . $id );
            } else if ($password !== $confirm_password) {
                setError( "Please make sure both passwords provided are the same", 'manage-users-changepwd?id=' . $id );
            }

    // 4. update the password. Remember hash the password before update
        //sql
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        //query
            $query = $database -> prepare($sql);

        //query->execute
            $query->execute([
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'id' => $id
            ]);


    // 5. redirect back to /manage-users
        header("Location: /manage-users");
        exit;