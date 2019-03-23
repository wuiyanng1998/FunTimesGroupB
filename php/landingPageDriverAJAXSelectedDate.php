<?php

require_once('phpDatabaseConnection.php');

function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

// Typically, this would be a call to a database
function findBooking($driver_id, $trip_date)
{
    $trip_date_beginning = $trip_date . " 00:00:00";
    $trip_date_end = $trip_date . " 23:59:59";

    $connection = connectToDb();
    $qryBooking = "SELECT booking_id, booking_time, start_post_code, end_post_code, booking.number_of_travelers, vehicle_name 
                  FROM booking JOIN route ON route.route_id=booking.route_id JOIN vehicle ON booking.vehicle_id=vehicle.vehicle_id 
                  WHERE driver_id ='" . $driver_id . "' AND booking_time BETWEEN  '" . $trip_date_beginning . "' 
                  AND '" . $trip_date_end . "' ORDER BY booking_time ASC";

    if ($result = mysqli_query($connection, $qryBooking)) {
        $bookingList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $specificBooking = [];
            $specificBooking[] = $row["booking_id"];
            $specificBooking[] = $row["booking_time"];
            $specificBooking[] = $row["start_post_code"];
            $specificBooking[] = $row["end_post_code"];
            $specificBooking[] = $row["number_of_travelers"];
            $specificBooking[] = $row["vehicle_name"];
            $bookingList[][] = $specificBooking;
        }

        return $bookingList;
    } else {
        return "Error with json encoding";
    }
}

if (!is_ajax_request()) {
    exit;
}

$driver_id = isset($_GET['q']) ? (int)$_GET['q'] : -1;

$trip_day = isset($_GET['day']) ? (int)$_GET['day'] : -1;
$trip_month = isset($_GET['month']) ? (int)$_GET['month'] : -1;
$trip_year = isset($_GET['year']) ? (int)$_GET['year'] : -1;

$trip_date = $trip_year."-".$trip_month."-".$trip_day;

$bookingList = findBooking($driver_id, $trip_date);

echo json_encode($bookingList);


