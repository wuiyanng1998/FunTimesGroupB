<?php

require_once('phpDatabaseConnection.php');


function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

// Typically, this would be a call to a database
function findBooking($driver_id)
{
    $connection = connectToDb();
    $qryBooking = "SELECT booking_id, booking_time, start_post_code, end_post_code, booking.number_of_travelers, vehicle_name 
                  FROM booking JOIN route ON route.route_id=booking.route_id JOIN vehicle ON booking.vehicle_id=vehicle.vehicle_id 
                  WHERE driver_id ='$driver_id' AND booking_time > NOW() ORDER BY booking_time ASC LIMIT 10";

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
        return "Error with car cost json encoding";
    }
}

if (!is_ajax_request()) {
    exit;
}

$driver_id = isset($_GET['q']) ? (int)$_GET['q'] : 1;

$bookingList = findBooking($driver_id);

echo json_encode($bookingList);


