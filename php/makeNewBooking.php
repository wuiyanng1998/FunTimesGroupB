<?php

require_once('phpDatabaseConnection.php');


//Variables that are not printing
$start_address = $_POST['pickup_address_post'];
$end_address = $_POST['dropoff_address_post'];
$pickupDate = $_POST['pickup_date_post'];
$pickupTime = $_POST['pickup_time_post'];
$service_fee = $_POST['service_rate_car'];
$numberOfPassengers = $_POST['number_passengers_post'];


//Variables that are printing
$carName = $_POST['car_type_post'];
$start_post_code = $_POST['pickup_address_api'];
$end_post_code = $_POST['dropoff_address_api'];


$pickupDateTime = $pickupDate . " " . $pickupTime . ":00";
print ("Pickup Date Time:" . $pickupDateTime . "<br>");

function readCookiesBookerId()
{
    if (isset($_COOKIE["bookerId"])) {
        $booker_id = $_COOKIE["bookerId"];
        print("bookerId: " . $booker_id . "<br> User ID: " . $_COOKIE["userId"]);
        print(PHP_EOL);
        return $booker_id;
    } else {
        print("Never heard of you.\n");
    }
}

function readCookiesUserId()
{
    if (isset($_COOKIE["userId"])) {
        $user_id = $_COOKIE["userId"];
        print(PHP_EOL);
        return $user_id;
    } else {
        print("Never heard of you.\n");
    }
}

//GET booker_id from COOKIES. We will get user_id here. We need then query booker_id
$booker_id = readCookiesBookerId();
$user_id = readCookiesUserId();

print("<br> Start address API: " . $start_post_code . "<br> Start address User: " . $start_address . "<br> End address API: " . $end_post_code . "<br> End address user: " . $end_address . "<br> Date:" . $pickupDate . "<br> Time:" . $pickupTime . "<br> No. Passengers: " . $numberOfPassengers . "<br> Vehicle Type: " . $carName . "<br> Price: " . $service_fee . "<br>");


$connection = connectToDb();

//$qryGetLatestID = "SELECT LAST_INSERT_ID()";

//Getting Route ID
$qryFindRoute = "SELECT route_id FROM route WHERE start_address='$start_address' AND start_post_code='$start_post_code'AND end_address = '$end_address' AND end_post_code = '$end_post_code'";

$qryAddRoute = "INSERT INTO route(`start_address`, `start_post_code`, `end_address`, `end_post_code`) VALUES('$start_address', '$start_post_code', '$end_address', '$end_post_code')";

$result = mysqli_query($connection, $qryFindRoute);
// check the query worked
if (!$result) {
    //If route is not found
    $result1 = mysqli_query($connection, $qryAddRoute);
    $routeID = findLatestRouteId($connection);
    echo "created new route";
} else {
    $routeID = mysqli_fetch_assoc($result)["route_id"];

    echo "Either Couldn't create ROUTE or found the right route";
}

function findLatestRouteId($connection)
{
    $qryGetLatestRouteID = "SELECT route_id from route ORDER BY route_id DESC LIMIT 1";
    $result2 = mysqli_query($connection, $qryGetLatestRouteID);
    if ($result2) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $routeID = $row['route_id'];
            print ("<br> Found routeID " . $routeID);
            return $routeID;
        }
    }
}

//-----------------------------//COME BACK TO THIS
//Find a car
$qryFindVehicle = "SELECT * FROM vehicle WHERE vehicle_name='$carName'";
$result = mysqli_query($connection, $qryFindVehicle);

// check the query worked
if ($result) {

    $vehicle_id = mysqli_fetch_assoc($result)["vehicle_id"];
    print ("<br> Found vehicle ID: " . $vehicle_id . "<br>");

} else {
    print("Couldn't find vehicle");
}

$hourMinute = explode(":", $pickupTime);
$pickupHour = $hourMinute[0];
$pickupMinute = $hourMinute[1];

$pickupHourLess2hr = $pickupHour - 2;

$pickupHourMore2hr = $pickupHour + 2;

$pickupDateLess = $pickupDate;
$pickupDateMore = $pickupDate;

//If the trip is close to midnight
if ($pickupHourLess2hr < 0) {
    $YearMonthDay = explode("-", $pickupDate);
    $pickupDay = $YearMonthDay[2];
    $pickupDay = $pickupDay - 1;
    $YearMonthDay = $YearMonthDay[0] . "-" . $YearMonthDay[1] . "-" . $pickupDay;
    $pickupHourLess2hr = 24 + $pickupHourLess2hr;
}

//If the trip is close to midnight
if ($pickupHourMore2hr > 24) {
    $YearMonthDay = explode("-", $pickupDate);
    $pickupDay = $YearMonthDay[2];
    $pickupDay = $pickupDay + 1;
    $YearMonthDay = $YearMonthDay[0] . "-" . $YearMonthDay[1] . "-" . $pickupDay;
    $pickupHourMore2hr = 0 + $pickupHourMore2hr;
}

//CHECK THIS
//$pickupDateTime = $pickupDate . " " . $pickupTime . ":00";

$searchDateBefore = $pickupDateLess . " " . $pickupHourLess2hr . ":" . $pickupMinute . "<br>";
$searchDateAfter = $pickupDateMore . " " . $pickupHourMore2hr . ":" . $pickupMinute . "<br>";
print ($searchDateBefore);
print ($searchDateAfter);

$qryFindUnavailableDriver = "SELECT driver_id FROM booking WHERE booking_time BETWEEN '$searchDateBefore'
  AND '$searchDateAfter'";

$result = mysqli_query($connection, $qryFindUnavailableDriver);
// check the query worked
$unavailableDrivers = [];
if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {
        $driver_id = $row['driver_id'];
        $unavailableDrivers[] = $driver_id;
    }

    print_r($unavailableDrivers);

    /*while ($row = mysqli_fetch_assoc($result)) {
        $driver_id = $row["driver_id"];
        $unavailableDrivers[] = "/" . $driver_id . "/";

    }
    print ("< br> Found unavailable drivers ID " . $unavailableDrivers);

} else {
    print("All drivers available");*/

} else {
    print("All drivers available");

}

print("<br> Length of unavailable drivers:" . sizeof($unavailableDrivers) . "<br>");

$whereArray = "('" . implode("','", $unavailableDrivers) . "')";
print($whereArray);

/*$qryFindDriver = "SELECT driver_id FROM booking WHERE booking_time
  BETWEEN '$searchDateBefore' AND '$searchDateAfter' AND driver_id NOT IN ('$unavailableDrivers') GROUP BY driver_id ORDER BY COUNT(driver_id) ASC LIMIT 1";
*/

$qryFindDriver = "SELECT driver_id FROM booking WHERE booking_time 
  BETWEEN '$searchDateBefore' AND '$searchDateAfter' AND driver_id NOT IN ('" . implode("','", $unavailableDrivers) . "') GROUP BY driver_id ORDER BY COUNT(driver_id) ASC LIMIT 1";


$result = mysqli_query($connection, $qryFindDriver);
// check the query worked
//$driver_id = 0;
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $driver_id = $row['driver_id'];
    }
    print ("<br> Found available driver ID = " . $driver_id);

} else {
    print("Couldn't find available drivers");

}

$qryAddBooking = "INSERT INTO booking(`booking_time`, `vehicle_id`, `number_of_travelers`, `booker_id`, `driver_id`,
    `service_fee`, `route_id`) VALUES('$pickupDateTime', '$vehicle_id', '$numberOfPassengers', '$booker_id', '$driver_id', '$service_fee', '$routeID')";

$qryGetLatestBookingID = "SELECT booking_id from booking ORDER BY booking_id DESC LIMIT 1";
$bookingID = mysqli_query($connection, $qryGetLatestBookingID);

$travelerIDList = [];

for ($i = 1; $i <= $numberOfPassengers; $i++) {
    ${"passengerFirstName" . $i} = $_POST['passenger_first_name_hidden_' . $i];
    ${"passengerLastName" . $i} = $_POST['passenger_last_name_hidden_' . $i];
    ${"passengerEmail" . $i} = $_POST['passenger_email_hidden_' . $i];
    ${"passengerPhoneNo" . $i} = $_POST['passenger_phone_hidden_' . $i];
    $passengerFirstName = ${"passengerFirstName" . $i};
    $passengerLastName = ${"passengerLastName" . $i};
    $passengerEmail = ${"passengerEmail" . $i};
    $passengerPhoneNo = ${"passengerPhoneNo" . $i};

    print("<br> Passenger $i: <br> Name: $passengerFirstName <br> Last Name: $passengerLastName <br> Email: $passengerEmail<br>
Phone: $passengerPhoneNo <br>");

    /*-----------------------ALL QUERIES HERE


    //Find existing travelers
    $qryFindTraveler = "SELECT traveler_id FROM traveler JOIN loginuser ON traveler . user_id = loginuser . user_id
    WHERE first_name = '$passengerFirstName' AND last_name = '$passengerLastName'
    AND email = '$passengerEmail' AND phone_number = '$passengerPhone'";

    //Add traveler queries
    $qryAddTraveler = "INSERT INTO traveler(`first_name`, `last_name`, `phone_number`, `email`)
    VALUES('$passengerFirstName', '$passengerLastName', '$passengerPhone', '$passengerEmail')";
    $resultTraveler = mysqli_query($connection, $qryAddTraveler);

    //Add traveler to traveler list
    $qryAddTravelerList = "INSERT INTO travelerlist(`booking_id`, `traveler_id`) VALUES('$bookingID', '$travelerID')";

    //Find latest traveler ID
    $qryGetLatestTravelerID = "SELECT traveler_id from traveler ORDER BY traveler_id DESC LIMIT 1";
    $resultGetTravelerID = mysqli_query($connection, $qryGetLatestTravelerID);
    $latestTravelerID = mysqli_fetch_assoc($resultGetTravelerID)['traveler_id'];
    print ("<br> Latest Traveler ID: " . $latestTravelerID);
--------------------------------------------*/


    $qryFindTraveler = "SELECT traveler_id FROM traveler JOIN loginuser ON traveler . user_id = loginuser . user_id 
    WHERE first_name = '$passengerFirstName' AND last_name = '$passengerLastName' 
    AND email = '$passengerEmail' AND phone_number = '$passengerPhoneNo'";

    $resultFindExistingTraveler = mysqli_query($connection, $qryFindTraveler);
    $travelerID = "";

    $qryGetLatestTravelerID = "SELECT traveler_id from traveler ORDER BY traveler_id DESC LIMIT 1";
    $resultGetLatestTravelerID = mysqli_query($connection, $qryGetLatestTravelerID);
    $latestTravelerID = mysqli_fetch_assoc($resultGetLatestTravelerID)['traveler_id'];
    print ("<br> Latest Traveler ID: " . $latestTravelerID);

    // check the query worked
    if ($resultFindExistingTraveler) { //i.e. the travelers already exist, just take the exiting booking and traveler ids and insert into traveler list

        $travelerIDList[] = $travelerID;
        $qryAddTravelerList = "INSERT INTO travelerlist(`booking_id`, `traveler_id`) VALUES('$bookingID', '$travelerID')";
        $resultAddExistingTravelerToTravelerList = mysqli_query($connection, $qryAddTravelerList);
        if ($resultAddExistingTravelerToTravelerList) {
            echo "Adding existing traveler to traveler list successful.";
        } else {
            echo "Error: adding existing traveler to traveler list unsuccessful.";
        }

    } else { //i.e. travelers do not currently exist, need to add them to traveler table along with booking id and then add to traveler list

        $qryAddTraveler = "INSERT INTO traveler(`first_name`, `last_name`, `phone_number`, `email`)
        VALUES('$passengerFirstName', '$passengerLastName', '$passengerPhone', '$passengerEmail')";

        $resultTraveler = mysqli_query($connection, $qryAddTraveler);
        $resultAddNewTraveler = mysqli_query($connection, $qryAddTraveler);

//            $result2 = mysqli_query($connection, $qryGetLatestID); NEED TO ASK ZHASLAN ABOUT THIS - WHICH LATEST ID WAS HE GETTING?
        $resultGetLatestBookingID = mysqli_query($connection, $qryGetLatestBookingID);

        if (!$resultGetLatestBookingID) {
            echo "Couldn't find added traveler's id " . $i;
        } else {
            $travelerID = $latestTravelerID;
            $travelerIDList[] = $travelerID;
            $qryAddTravelerList = "INSERT INTO travelerlist(`booking_id`, `traveler_id`) VALUES('$bookingID', '$travelerID')";
            $resultAddNewTravelerToTravelerList = mysqli_query($connection, $qryAddTravelerList);
            if (!$resultAddNewTravelerToTravelerList) {
                echo "Couldn't create traveler list for traveler " . $i;
            }
        }


    }

    closeDb($connection);

}

