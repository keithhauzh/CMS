<?php
// connection to database
$database = connectToDB();

//3. get all the data from the signup form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//4. do checking
if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
    setError("Please fill in all the fields.", "/signup");
} else if ($password !== $confirm_password){
    // check if both passwords are filled in the same
    setError("Passwords do not match.", "/signup");
} else if (strlen ($password) < 8) {
    //check if password is 8 characters long
    setError("Please make sure your password is at least 8 characters long.", "/signup");
} else {
    //check if the email is already in use or not
    //sql command
    $sql = "SELECT * FROM users WHERE email = :email";

    //prepare
    $query = $database -> prepare($sql);

    //execute
    $query -> execute ([
        'email' => $email
    ]);

    $user = $query -> fetch(); //return the first row starting from the query

    if ( $user ) {
        setError("The email provided is already registered in our database", "/signup");
    } else {
        //create a user account
        $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";

        //prepare
        $query = $database -> prepare($sql);

        //execute
        $query -> execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT) //password is hashed
        ]);

        $_SESSION["success"] = "Account has been created successfully.";

        header("Location: /login");
        exit;
    }
}

