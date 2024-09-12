<?php
// connection to database
$database = connectToDB();

//3. get all the data from the login form
$email = $_POST['email'];
$password = $_POST['password'];

//4. do checking
if ( empty($email) || empty($password) ) {
    setError("Please fill in all fields.", "/login");
} else {
    //check if email is already registered

    //sql command
    $sql = "SELECT * FROM users WHERE email = :email";

    //prepare
    $query = $database -> prepare($sql);

    //execute 
    $query -> execute([
        'email' => $email
    ]);

    //5.4 fetch
    $user = $query -> fetch();

    if ($user) {
        // check if password is correct or not
        if ( password_verify ($password, $user['password'])) {
            //login the user
            $_SESSION['loggeduser'] = $user;

            //display success message
            $_SESSION['success'] = 'Login successful! Have fun!';

            //redirect to home page (dashboard)
            header("Location:/dashboard");
            exit;
        } else {
            setError("Your password is incorrect.", "/login");
        }
    } else {
        setError("The email provided is not registered in our database.", "/login");
    }
}

