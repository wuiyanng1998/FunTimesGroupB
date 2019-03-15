<?php

require_once('phpDatabaseConnection.php');


function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

// Typically, this would be a call to a database
function calculateTravelCost($booker_id)
{
    $connection = connectToDb();
    $qryBooking = "SELECT booking_id, booking_time, start_post_code, end_post_code, service_fee, vehicle_name 
                  FROM booking JOIN route ON route.route_id=booking.route_id JOIN vehicle ON booking.vehicle_id=vehicle.vehicle_id 
                  WHERE booker_id ='$booker_id' AND booking_time > NOW()";

    if ($result = mysqli_query($connection, $qryBooking)) {
        $bookingList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $specificBooking = [];
            $specificBooking[] = $row["booking_id"];
            $specificBooking[] = $row["booking_time"];
            $specificBooking[] = $row["start_post_code"];
            $specificBooking[] = $row["end_post_code"];
            $specificBooking[] = $row["vehicle_name"];
            $specificBooking[] = $row["service_fee"];
            $bookingList[] = $specificBooking;
        }
        return $bookingList;
    } else {
        print "Error with car cost json encoding";
    }
}

if (!is_ajax_request()) {
    exit;
}

$booker_id = isset($_GET['q']) ? (int)$_GET['q'] : 1;

$bookingList = calculateTravelCost($booker_id);

echo json_encode($bookingList);


