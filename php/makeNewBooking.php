<?php
require_once('phpDatabaseConnection.php');

$pickupDate = $_POST['$pickup_date'] ?? '1'; //PHP 7.0
$pickupTime = $_POST['$pickup_time'] ?? '1';
$numberOfPassengers = $_POST['number_passengers'] ?? '1';
$numberOfLuggage = $_POST['luggage'] ?? '1';
$carType = $_POST['car_type'] ?? '1';


for ($i = 1; $i <= $numberOfPassengers; $i++) {
    ${"passengerName" . $i} = $_POST['passenger_name_' . $i];
    ${"passengerEmail" . $i} = $_POST['passenger_email_' . $i];
    ${"passengerPhoneNo" . $i} = $_POST['passenger_phone_' . $i];
}

$pickupDateTime = $pickupDate . " " . $pickupTime . ":00";
switch ($carType) {
    case "e-class":
        $carType = 1;
        break;

    case "s-class":
        $carType = 2;
        break;

    case "v-class":
        $carType = 3;
        break;

    case "rr":
        $carType = 4;
        break;

    case "phantom":
        $carType = 5;
        break;

    case "mulsanne":
        $carType = 6;
        break;
}


//GET booker_id from COOKIES. We will get user_id here. We need then query booker_id
$booker_id = 0;

$qryAddBooking = "INSERT INTO booking (booking_time, vehicle_id, number_of_travelers, number_of_luggages, booker_id, ";
$qryAddBooking .= "driver_id, service_fee, route_id) VALUES ('" . $pickupDateTime . "', '" . $carType . "', '"
    . $numberOfPassengers . "', '" . $numberOfLuggage . "', '" . $booker_id . ")";


$qryFindTraveler = 0;
//Add traveler query

$qryFind = "SELECT * from film join film_actor on film.film_id = film_actor.film_id";
$qryFind .= " JOIN actor on actor.actor_id= film_actor.actor_id";
$qryFind .= " WHERE CONCAT( first_name, ' ', last_name) LIKE '%" . $search . "%'";
$qryFind .=" OR  CONCAT(last_name, ' ', first_name)LIKE '%".$search . "%'
        UNION
        SELECT * from film join film_actor on film.film_id = film_actor.film_id ";
$qryFind .="JOIN actor on actor.actor_id= film_actor.actor_id WHERE title LIKE '%".$search . "%'";



$qryDisableFK = "SET FOREIGN_KEY_CHECKS=0";
$qryEnableFK = "SET FOREIGN_KEY_CHECKS=1";


$connection = connectToDb();

mysqli_query($connection, $qryDisableFK);

//Check if the name exists
$result = mysqli_query($connection, $qryFind);
if (mysqli_num_rows($result) > 0) {
    session_start();
    $output = "You successfully logged in";
    $_SESSION['output'] = $output;
    header('Location: loginResult.php');

} else {
    $result = mysqli_query($connection, $qryAddBooking);
    // check the query worked
    if ($result) {
        session_start();
        $output = "We could not find your details. 
        We created new account for you.";
        $_SESSION['output'] = $output;
        mysqli_query($connection, $qryEnableFK);
        closeDb($connection);
        header('Location: loginResult.php');
    } else {
        session_start();
        $output = mysqli_error($connection);
        $_SESSION['output'] = $output;
        mysqli_query($connection, $qryEnableFK);
        closeDb($connection);
        header('Location: loginResult.php');
        exit;
    }
}

