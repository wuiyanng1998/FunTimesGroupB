<?php
require_once('phpDatabaseConnection.php');

$pickupDate = $_POST['pickup_date'];
$pickupTime = $_POST['pickup_time'];
$numberOfPassengers = $_POST['number_passengers'];
$numberOfLuggage = $_POST['luggage'];
$carType = $_POST['carType'];

$start_address = $_POST['pickup_address'];
$start_post_code = $_POST['pickup_address_api'];
$end_address = $_POST['dropoff_address'];
$end_post_code = $_POST['dropoff_address_api'];
$travel_time = $_POST['travel_time_api'];
$price = $_POST['service_rate_car'];

for ($i = 1; $i <= $numberOfPassengers; $i++) {
    ${"passengerFirstName" . $i} = $_POST['passenger_first_name_' . $i];
    ${"passengerLastName" . $i} = $_POST['passenger_last_name_' . $i];
    ${"passengerEmail" . $i} = $_POST['passenger_email_' . $i];
    ${"passengerPhoneNo" . $i} = $_POST['passenger_phone_' . $i];
}

$pickupDateTime = $pickupDate . " " . $pickupTime . ":00";


function readCookiesBookerId()
{
    if (isset($_COOKIE["bookerId"])) {
        $booker_id = $_COOKIE["bookerId"];
        print("bookerId: " . $booker_id . "User ID: " . $_COOKIE["userId"]);
        print(PHP_EOL);
        return $booker_id;
    } else {
        print("Never heard of you.\n");
    }
}

function readCookiesUserId()
{
    if (isset($_COOKIE["bookerId"])) {
        $user_id = $_COOKIE["user_id"];
        print(PHP_EOL);
        return $user_id;
    } else {
        print("Never heard of you.\n");
    }
}

//GET booker_id from COOKIES. We will get user_id here. We need then query booker_id
$booker_id = readCookiesBookerId();
$user_id = readCookiesUserId();


$qryAddRoute = "INSERT INTO route (start_address, start_post_code, end_address, end_post_code) VALUES ('"
    . $start_address . "', '" . $start_post_code . "', '" . $end_address . "', '"
    . $end_post_code . "')";

$qryGetLatestID = "SELECT LAST_INSERT_ID()";

$connection = connectToDb();

//Check if the name exists

$result = mysqli_query($connection, $qryAddRoute);
// check the query worked
if ($result) {
    $routeID = mysqli_query($connection, $qryGetLatestID);
    closeDb($connection);
} else {
    echo "Couldn't create ROUTE";
    closeDb($connection);
    exit;
}


$qryAddBooking = "INSERT INTO booking (booking_time, vehicle_id, number_of_travelers, number_of_luggages, booker_id, 
                     driver_id, service_fee, route_id) VALUES ('" . $pickupDateTime . "', '" . $carName . "', '"
    . $numberOfPassengers . "', '" . $numberOfLuggage . "', '" . $booker_id . "', '"
//    . $driver_id NOT IMPLEMENTED
    . "', '" . $service_fee . "', '" . $routeID . "')";
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


