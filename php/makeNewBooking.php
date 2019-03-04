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
    ${"passengerFirstName" . $i} = $_POST['passenger_first_name_' . $i];
    ${"passengerLastName" . $i} = $_POST['passenger_last_name_' . $i];
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

$qryAddRoute = "INSERT INTO route (start_address, start_post_code, end_address, end_post_code) VALUES ('"
    . $start_address . "', '" . $start_post_code . "', '" . $end_address . "', '"
    . $end_post_code . ")";


$qryGetLatestID = "SELECT LAST_INSERT_ID()";

$connection = connectToDb();

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


$qryAddBooking = "INSERT INTO booking (booking_time, vehicle_id, number_of_travelers, number_of_luggages, booker_id, ";
$qryAddBooking .= "driver_id, service_fee, route_id) VALUES ('" . $pickupDateTime . "', '" . $carType . "', '"
    . $numberOfPassengers . "', '" . $numberOfLuggage . "', '" . $booker_id . ")";
$bookingID = mysqli_query($connection, $qryGetLatestID);


$travelerIDList = [];

for ($i = 1; $i <= $numberOfPassengers; $i++) {
    $qryFindTraveler =
        "SELECT traveler_id FROM traveler JOIN loginuser ON traveler.user_id = loginuser.user_id WHERE first_name ='"
        . $passengerFirstName . "' AND last_name ='" . $passengerLastName . "' AND email ='"
        . $passengerEmail . "' AND phone_number ='" . $passengerPhone . "'";

    $qryAddTraveler = "INSERT INTO loginuser (email, password) VALUES ('"
        . $passengerEmail . "', '" . $passengerPassword .
        "'); INSERT INTO traveler (first_name, last_name, phone_number, user_id) VALUES ('"
        . $passengerFirstName . "', '" . $passengerLastName . "', '" . $passengerPhone . "', LAST_INSERT_ID() );";

    $result = mysqli_query($connection, $qryFindTraveler);
    // check the query worked
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $travelerID = $row['traveler_id'];
        $travelerIDList[] = $travelerID;
        $qryAddTravelerList = "INSERT INTO travelerlist (booking_id, traveler_id) VALUES (" . $bookingID . ", "
            . $travelerID . ")";
        mysqli_query($connection, $qryAddTravelerList);
    } else {
        $result = mysqli_query($connection, $qryAddTraveler);
        $travelerID = mysqli_query($connection, $qryGetLatestID);
        $travelerIDList[] = $latestID;
        $qryAddTravelerList = "INSERT INTO travelerlist (booking_id, traveler_id) VALUES (" . $bookingID . ", "
            . $travelerID . ")";
        mysqli_query($connection, $qryAddTravelerList);
    }
}

for ($i = 1; $i <= $numberOfPassengers; $i++) {

    $qryAddTravelerList = "INSERT INTO travelerlist (booking_id, traveler_id) VALUES (" . $bookingID . ", " . $travelerIDList[i] . ")";
    mysqli_query($connection, $qryAddTravelerList);
}

