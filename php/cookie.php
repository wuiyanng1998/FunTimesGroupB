<?php

require_once('phpDatabaseConnection.php');

if ($_POST["type"] == 1){
    setCookies();
} else {
    readCookies();
}

function setCookies()
{
    $connection = connectToDb();
    $cookie_email = $_POST['email'] ?? '1';
    echo nl2br ("Get email successful: " . $cookie_email . "\n");

// Build the query statement, shown in two steps as you might need this for your coursework
    $email_search = "SELECT * FROM loginuser WHERE email = '$cookie_email'";

// Execute the query and retrieve the results

    $userIdExists = mysqli_query($connection, $email_search);
    echo nl2br (mysqli_num_rows($userIdExists));


//If there is no existing email in the database, create a new unique user_ID
    if (mysqli_num_rows($userIdExists) == 0) {
        $min = 0;
        $max = 2000;

        //Check that the new user_ID assigned is unique in the database
        do {
            $cookie_user_id = rand($min, $max);
            $user_id_search = "SELECT * FROM loginuser WHERE user_id = '$cookie_user_id'";
            $result_user_id = mysqli_query($connection, $user_id_search);
            setcookie("email", $cookie_email, time()+(86400*30), "/" ); //expires after 30 days
            setcookie("user_id", $cookie_user_id, time()+(86400*30), "/" );
            print("Email: " . $_COOKIE["email"] . "User ID: " . $_COOKIE["user_id"]);
            print (PHP_EOL);
        }
        while (mysqli_num_rows($result_user_id) != 0);

    }

    else {
        $get_user_id = "SELECT user_id FROM loginuser WHERE email = '$cookie_email'";
        $result = mysqli_query($connection, $get_user_id);
        $cookie_user_id = mysqli_fetch_assoc($result);
        setcookie("email", $cookie_email, time()+(86400*30), "/"); //expires after 30 days
        setcookie("user_id", $cookie_user_id,time()+(86400*30), "/");
        print_r($_COOKIE);
    }

    exit;

}

function readCookies(){
    if (isset($_COOKIE["cookie_email"])) {
        print("Email: " . $_COOKIE["email"] . "User ID: " . $_COOKIE["user_id"]);
        print(PHP_EOL);
    } else {
        print("Never heard of you.\n");
    }
    print("All cookies received:\n");
    print_r($_COOKIE);
}
