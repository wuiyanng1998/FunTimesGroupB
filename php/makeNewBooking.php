<?php

require_once('phpDatabaseConnection.php');


//Variables that are not printing
$start_address = $_POST['pickup_address_post'];
$end_address = $_POST['dropoff_address_post'];
$pickupDate = $_POST['pickup_date_post'];
$pickupTime = $_POST['pickup_time_post'];
$service_fee = $_POST['service_rate_car'];
$numberOfPassengers = $_POST['number_passengers_post'];

$service_fee = substr($service_fee, 2);

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
if (mysqli_num_rows($result) == 0) {
    //If route is not found
    $result1 = mysqli_query($connection, $qryAddRoute);
    $routeID = findLatestRouteId($connection);
    echo "created new route";
    echo $routeID;
} else {
    $routeID = mysqli_fetch_assoc($result)["route_id"];
    echo "Either Couldn't create ROUTE or found the right route";
    echo $routeID;
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


//Find a car
$qryFindVehicle = "SELECT * FROM vehicle WHERE vehicle_name='$carName'";
$result = mysqli_query($connection, $qryFindVehicle);
$vehicle_id = mysqli_fetch_assoc($result)["vehicle_id"];
print ("<br> Found vehicle ID: " . $vehicle_id . "<br>");

// check the query worked
//if ($result) {
//    $vehicle_id = mysqli_fetch_assoc($result)["vehicle_id"];
//    print ("<br> Found vehicle ID: " . $vehicle_id . "<br>");
//
//} else {
//    print("Couldn't find vehicle");
//}


//Find a driver

//Get time span of the travel
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
    $searchDateBefore = $YearMonthDay . " " . $pickupHourLess2hr . ":" . $pickupMinute . ":00";
    $searchDateDayBefore = $YearMonthDay . " 00:00:00";
} else {
    $searchDateBefore = $pickupDateLess . " " . $pickupHourLess2hr . ":" . $pickupMinute . ":00";
    $searchDateDayBefore = $pickupDateLess . " 00:00:00";
}

//If the trip is close to midnight
if ($pickupHourMore2hr > 24) {
    $YearMonthDay = explode("-", $pickupDate);
    $pickupDay = $YearMonthDay[2];
    $pickupDay = $pickupDay + 1;
    $YearMonthDay = $YearMonthDay[0] . "-" . $YearMonthDay[1] . "-" . $pickupDay;
    $pickupHourMore2hr = 0 + $pickupHourMore2hr - 24;
    $searchDateAfter = $YearMonthDay . " " . $pickupHourMore2hr . ":" . $pickupMinute . ":00";
    $searchDateDayAfter = $YearMonthDay . " 23:59:59";
} else {
    $searchDateAfter = $pickupDateMore . " " . $pickupHourMore2hr . ":" . $pickupMinute . ":00";
    $searchDateDayAfter = $pickupDateMore . " 23:59:59";
}

print ("Search date before: " . $searchDateBefore . "<br>");
print ("Search date After: " . $searchDateAfter . "<br>");


//Finding all unavailable drivers
$qryFindUnavailableDriver =
    "SELECT driver_id FROM booking WHERE booking_time BETWEEN '$searchDateBefore' AND '$searchDateAfter'";

//Query all unavailable drivers
$result = mysqli_query($connection, $qryFindUnavailableDriver);
// check the query worked
$unavailableDrivers = [];
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $driver_id = $row['driver_id'];
        $unavailableDrivers[] = $driver_id;
    }
} else {
    print("All drivers available");
}

print("<br> Length of unavailable drivers:" . sizeof($unavailableDrivers) . "<br>");


//convert array of unavailable drivers to string match sql format
$whereArray = implode(", ", $unavailableDrivers);
print("<br> Where array: " . $whereArray . "<br>");

//Query all available drivers with at least one booking on booking day
if (sizeof($unavailableDrivers) == 0) {
    print ("Unavailable Driver is 0 i.e. no unavailable drivers <br>");
    $qryFindDriverAtLeast1 = "SELECT driver_id FROM booking WHERE booking_time BETWEEN '$searchDateDayBefore' 
    AND '$searchDateDayAfter' AND driver_id GROUP BY driver_id ORDER BY COUNT(driver_id) ASC";
    $result = mysqli_query($connection, $qryFindDriverAtLeast1);
    $availableDriversAtLeast1 = [];

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $driver_id = $row['driver_id'];
            $availableDriversAtLeast1[] = $driver_id;
            print ("Found some available drivers with at least 1 booking <br>");
        }
    } else {
        print("All drivers available");
    }
} else {
    print ("Unavailable Driver is greater than 0 i.e. there are some unavailable drivers <br>");
//    Find drivers with at least one booking on the day excluding unavailable drivers
    $qryFindDriverAtLeast1 = "SELECT driver_id FROM booking WHERE booking_time 
    BETWEEN '$searchDateDayBefore' AND '$searchDateDayAfter' AND driver_id NOT IN ('$whereArray') GROUP BY driver_id ORDER BY COUNT(driver_id) ASC";
    $result = mysqli_query($connection, $qryFindDriverAtLeast1);
    $availableDriversAtLeast1 = [];
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $driver_id = $row['driver_id'];
            $availableDriversAtLeast1[] = $driver_id;
            print ("Found some available drivers with at least 1 booking excluding unavailable drivers <br>");
        }
    } else {
        print("No drivers available ");

        header("Location: ../errorPage.php?errorCode=3");
    }
}

print("<br> Length of at least 1 booking drivers:" . sizeof($availableDriversAtLeast1) . "<br>");

//convert array of available drivers to string match sql format
$whereArray2 = implode(", ", $availableDriversAtLeast1);
print("<br> Where array: " . $whereArray2 . "<br>");


$qryGetAllDrivers = "Select driver_id From driver";
$result = mysqli_query($connection, $qryGetAllDrivers);
$allDrivers = [];
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $driver_id = $row['driver_id'];
        $allDrivers[] = $driver_id;
        print ("worked all drivers list <br>");
    }
} else {
    print("No drivers found");
}

// Finding drivers with no bookings that day
$allMinusUnavailable = array_diff($allDrivers, $unavailableDrivers);
$driversWithNoBooking = array_diff($allMinusUnavailable, $availableDriversAtLeast1);
print ("<br> Drivers with no booking: ");
print_r($driversWithNoBooking);
print("<br>");


// Finding driver for the booking
if (sizeof($driversWithNoBooking) > 0) {
    $driver_id = $driversWithNoBooking[array_rand($driversWithNoBooking)];
    print("<br> Found available driver with no booking ID = " . $driver_id);
} else {
    $driver_id = $availableDriversAtLeast1[array_rand($availableDriversAtLeast1)];
    print("<br> Found available driver with at least one booking ID = " . $driver_id);
}


//Adding booking
print("<br> Booking Time: " . $pickupDateTime . "<br> Vehicle ID " . $vehicle_id . "<br> Number of Passengers: " . $numberOfPassengers . "<br> Booker ID: " . $booker_id . "<br> Driver ID: " . $driver_id . "<br> Service Fee: " . $service_fee . "<br> Route ID: " . $routeID . "<br>");
$qryAddBooking = "INSERT INTO booking(`booking_time`, `vehicle_id`, `number_of_travelers`, `booker_id`, `driver_id`,
    `service_fee`, `route_id`) VALUES('$pickupDateTime', '$vehicle_id', '$numberOfPassengers', '$booker_id', '$driver_id', '$service_fee', '$routeID')";
$makeBooking = mysqli_query($connection, $qryAddBooking);
$qryGetLatestBookingID = "SELECT booking_id from booking ORDER BY booking_id DESC LIMIT 1";
$bookingID = mysqli_query($connection, $qryGetLatestBookingID);


//Adding travelers
for ($i = 1; $i <= $numberOfPassengers; $i++) {
//    Getting details of passengers from forms
    print ("<br> loop:" . $i);
    $passengerFirstName = $_POST['passenger_first_name_hidden_' . $i];
    $passengerLastName = $_POST['passenger_last_name_hidden_' . $i];
    $passengerEmail = $_POST['passenger_email_hidden_' . $i];
    $passengerPhoneNo = $_POST['passenger_phone_hidden_' . $i];

    print("<br> Passenger $i: <br> Name: $passengerFirstName <br> Last Name: $passengerLastName <br> Email: $passengerEmail<br>
Phone: $passengerPhoneNo <br>");

    $qryFindTraveler = "SELECT traveler_id FROM traveler JOIN loginuser ON traveler . user_id = loginuser . user_id 
    WHERE first_name = '$passengerFirstName' AND last_name = '$passengerLastName' 
    AND email = '$passengerEmail' AND phone_number = '$passengerPhoneNo'";

    $qryGetLatestTravelerID = "SELECT traveler_id from traveler ORDER BY traveler_id DESC LIMIT 1";

    $resultFindExistingTraveler = mysqli_query($connection, $qryFindTraveler);

    // check the query worked
    if ($resultFindExistingTraveler || mysqli_num_rows($resultFindExistingTraveler) > 0) { //i.e. the travelers already exist, just take the exiting booking and traveler ids and insert into traveler list
        $resultGetLatestTravelerID = mysqli_query($connection, $qryGetLatestTravelerID);
        $travelerID = mysqli_fetch_assoc($resultGetLatestTravelerID)['traveler_id'];
        print ("<br> Latest Traveler ID: " . $travelerID);

        $qryAddTravelerList = "INSERT INTO travelerlist(`booking_id`, `traveler_id`) VALUES('$bookingID', '$travelerID')";
        $resultAddExistingTravelerToTravelerList = mysqli_query($connection, $qryAddTravelerList);
        if (mysqli_num_rows($resultAddExistingTravelerToTravelerList) != 0) {
            echo "Adding existing traveler to traveler list successful.";
        } else {
            echo "Error: adding existing traveler to traveler list unsuccessful.";
        }
    } else { //i.e. travelers do not currently exist, need to add them to traveler table along with booking id and then add to traveler list
        $qryAddTraveler = "INSERT INTO traveler(`first_name`, `last_name`, `phone_number`, `email`)
        VALUES('$passengerFirstName', '$passengerLastName', '$passengerPhoneNo', '$passengerEmail')";
        $resultAddNewTraveler = mysqli_query($connection, $qryAddTraveler);
        $resultGetLatestBookingID = mysqli_query($connection, $qryGetLatestTravelerID);
        $travelerID = mysqli_fetch_assoc($resultGetLatestBookingID)['traveler_id'];
        print("<br>" . $travelerID);
        $qryAddTravelerList = "INSERT INTO travelerlist(`booking_id`, `traveler_id`) VALUES('$bookingID', '$travelerID')";
        $resultAddNewTravelerToTravelerList = mysqli_query($connection, $qryAddTravelerList);
    }
}


$qryDeductBookerBudget = "Select finance_allowance From booker where booker_id = '$booker_id'";
$bookerInitialBudgetQry = mysqli_query($connection, $qryDeductBookerBudget);
$bookerInitialBudget = mysqli_fetch_assoc($bookerInitialBudgetQry)['finance_allowance'];
$bookerUpdatedBudget = $bookerInitialBudget - $service_fee;

if ($bookerUpdatedBudget > 0) {
    $qryDeductBookerBudget = "UPDATE booker SET finance_allowance = '$bookerUpdatedBudget' WHERE booker_id = '$booker_id'";
} else {
//    Error Insufficient funds
    echo("Insufficient funds");
    header("Location: ../errorPage.php?errorCode=2");
}


closeDb($connection);
