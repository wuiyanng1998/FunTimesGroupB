<?php
require_once('phpDatabaseConnection.php');

$pickupDate = $_POST['pickup_date'];
$pickupTime = $_POST['pickup_time'];
$numberOfPassengers = $_POST['number_passengers'];
$numberOfLuggage = $_POST['luggage'];
$carType = $_POST['car_type'];

$start_address = $_POST['pickup_address'];
$start_post_code = $_POST['pickup_address_api'];
$end_address = $_POST['dropoff_address'];
$end_post_code = $_POST['dropoff_address_api'];

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

$qryAddRoute = "INSERT INTO route (start_address, start_post_code, end_address, end_post_code)";
$qryAddRoute .= "VALUES ('" . $start_address . "', '" . $start_post_code . "', '" . $end_address . "', '"
    . $end_post_code . ")";


$qryGetLatestID = "SELECT LAST_INSERT_ID()";


$qryAddBooking = "INSERT INTO booking (booking_time, vehicle_id, number_of_travelers, number_of_luggages, booker_id, ";
$qryAddBooking .= "driver_id, service_fee, route_id) VALUES ('" . $pickupDateTime . "', '" . $carType . "', '"
    . $numberOfPassengers . "', '" . $numberOfLuggage . "', '" . $booker_id . ")";


$qryFindTraveler = 0;
//Add traveler query


$qryFind = "SELECT * from film join film_actor on film.film_id = film_actor.film_id";
$qryFind .= " JOIN actor on actor.actor_id= film_actor.actor_id";
$qryFind .= " WHERE CONCAT( first_name, ' ', last_name) LIKE '%" . $search . "%'";
$qryFind .= " OR  CONCAT(last_name, ' ', first_name)LIKE '%" . $search . "%'
        UNION
        SELECT * from film join film_actor on film.film_id = film_actor.film_id ";
$qryFind .= "JOIN actor on actor.actor_id= film_actor.actor_id WHERE title LIKE '%" . $search . "%'";


$qryDisableFK = "SET FOREIGN_KEY_CHECKS=0";
$qryEnableFK = "SET FOREIGN_KEY_CHECKS=1";


$connection = connectToDb();

//mysqli_query($connection, $qryDisableFK);

//Check if the name exists

$result = mysqli_query($connection, $qryAddRoute);
// check the query worked
if ($result) {
    closeDb($connection);
//    header('Location: loginResult.php');
} else {

    closeDb($connection);
//    header('Location: loginResult.php');
    exit;
}

