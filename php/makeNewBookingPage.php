<?php
/**
 * Created by PhpStorm.
 * User: wuiya
 * Date: 3/14/2019
 * Time: 9:44 PM
 */

require_once('phpDatabaseConnection.php');

$start = $_POST['pickup_address'];
$end = $_POST['dropoff_address'];
$start_post = $_POST['pickup_address_api'];
$end_post = $_POST['dropoff_address_api'];

$date = $_POST['pickup_date_post'];
$time = $_POST['pickup_time_post'];
$passengers = $_POST['number_passengers_post'];
//$start_post =;
//$end_post=;

$connection = connectToDb();

// Build the query statement
$insertBooking = "INSERT INTO booking (booking_time`, `vehicle_id`, `number_of_travelers`, `booker_id`, `driver_id`, `service_fee`, `route_id`) VALUES ('', '$hash')";
$insertRoute = "INSERT INTO route (`start_address`, `start_post_code`, `end_address`, `end_post_code`) VALUES ('$start', '$start_post', '$end', '$end_post')";
// Execute the query and insert
mysqli_query($connection, $insertBooking);

if ($connection->query($insertBooking) === TRUE) {
    echo "Booking created successfully <br>";
} else {
    echo "Error: " . $insertBooking . "<br>" . $connection->error . "<br>";
}

mysqli_query($connection, $insertRoute);

mysqli_query($connection, $insertBooking);

if ($connection->query($insertRoute) === TRUE) {
    echo "Route created successfully <br>";
} else {
    echo "Error: " . $insertRoute . "<br>" . $connection->error . "<br>";
}


