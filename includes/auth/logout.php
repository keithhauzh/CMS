<?php
    //session already started since page is printed in index.php

    //remove the user session
    unset ($_SESSION['loggeduser']);

    //redirect to home page
    header("Location:/");
    exit;