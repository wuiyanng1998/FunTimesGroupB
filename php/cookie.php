<?php

require_once('phpDatabaseConnection.php');

$identity = $_POST['myIdentity'] ?? 1;

if ($identity == 'Booker'){
    bookerCookies();
} else {
    driverCookies();
}

function bookerCookies()
{
    $connection = connectToDb();
    $cookie_email = $_POST['email'] ?? 1;

    // Build the query statement, shown in two steps as you might need this for your coursework
    $query = "SELECT booker.driver_id, booker.first_name, loginuser.user_id FROM loginuser JOIN booker ON loginuser.user_id = booker.user_id WHERE loginuser.email = '$cookie_email'";

// Execute the query and retrieve the results

    $results = mysqli_query($connection, $query);
    $array = mysqli_fetch_assoc($results);
    $booker_id = $array['booker_id'];
    $first_name = $array['first_name'];
    $user_id = $array['user_id'];

    setcookie("bookerId", $booker_id, time()+(86400*30), "/" );
    setcookie("firstName", $first_name, time()+(86400*30), "/" );
    setcookie("userId", $user_id, time()+(86400*30), "/" );

    exit;

}

function driverCookies()
{
    $connection = connectToDb();
    $cookie_email = $_POST['email'] ?? 1;

    // Build the query statement, shown in two steps as you might need this for your coursework

    $query = "SELECT driver.driver_id, driver.first_name, loginuser.user_id FROM loginuser JOIN driver ON loginuser.user_id = driver.user_id WHERE loginuser.email = '$cookie_email'";

// Execute the query and retrieve the results

    $results = mysqli_query($connection, $query);
    $array = mysqli_fetch_assoc($results);

    $driver_id = $array['driver_id'];
    $first_name = $array['first_name'];
    $user_id = $array['user_id'];

    setcookie("driverId", $driver_id, time()+(86400*30), "/" );
    setcookie("firstName", $first_name, time()+(86400*30), "/" );
    setcookie("userId", $user_id, time()+(86400*30), "/" );

    echo $_COOKIE["driverId"] . "<br>" .  $_COOKIE["firstName"] . "<br>" . $_COOKIE["userId"] . "<br>";
    print_r($_COOKIE);
    print(PHP_EOL);
    exit;
}

