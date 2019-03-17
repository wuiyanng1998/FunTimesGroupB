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
}

$pickupDateTime = $pickupDate . " " . $pickupTime . ":00";


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

$qryGetLatestID = "SELECT LAST_INSERT_ID()";

//Getting Route ID
$qryFindRoute = "SELECT route_id FROM route WHERE start_address='" . $start_address . "' AND start_post_code='"
    . $start_post_code . "'AND end_address = '" . $end_address . "' AND end_post_code = '" . $end_post_code . "'";

$qryAddRoute = "INSERT INTO route(start_address, start_post_code, end_address, end_post_code) VALUES('" . $start_address .
    "', '" . $start_post_code . "', '" . $end_address . "', '" . $end_post_code . "')";

$result = mysqli_query($connection, $qryFindRoute);
// check the query worked
$routeID = "";
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $routeID = $row["route_id"];
    }
    print (" < br> Found routeID FIND " . $routeID);
    closeDb($connection);
} else {
    $result1 = mysqli_query($connection, $qryAddRoute);
    $result2 = mysqli_query($connection, $qryGetLatestID);
    if ($result2) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $routeID = $row["LAST_INSERT_ID()"];
            print ("<br> Found routeID " . $routeID);
        }
    } else {
        echo "Couldn't create ROUTE";
    }
    closeDb($connection);
}

//Find a car
$qryFindVehicle = "SELECT vehicle_id FROM vehicle WHERE vehicle_name='" . $carName . "'";

$result = mysqli_query($connection, $qryFindVehicle);
// check the query worked
$vehicle_id = "";
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $vehicle_id = $row["vehicle_id"];
    }
    print ("< br> Found vehicle ID " . $vehicle_id);
    closeDb($connection);
} else {
    print("Couldnt find vehicle");
    closeDb($connection);
}


$qryAddBooking = "INSERT INTO booking(booking_time, vehicle_id, number_of_travelers, booker_id, driver_id,
    service_fee, route_id) VALUES('" . $pickupDateTime . "', '" . $vehicle_id . "', '" . $numberOfPassengers . "', '"
    . $booker_id . "', '3', '" . $service_fee . "', '" . $routeID . "')";

$bookingID = mysqli_query($connection, $qryGetLatestID);

$travelerIDList = [];

for ($i = 1; $i <= $numberOfPassengers; $i++) {
    $passengerFirstName = ${"passengerFirstName" . $i};
    $passengerLastName = ${"passengerLastName" . $i};
    $passengerEmail = ${"passengerEmail" . $i};
    $passengerPhone = ${"passengerPhoneNo" . $i};

    $qryFindTraveler =
        "SELECT traveler_id FROM traveler JOIN loginuser ON traveler . user_id = loginuser . user_id 
    WHERE first_name = '" . $passengerFirstName . "' AND last_name = '" . $passengerLastName . "' 
    AND email = '" . $passengerEmail . "' AND phone_number = '" . $passengerPhone . "'";

    $qryAddTraveler = "INSERT INTO traveler(first_name, last_name, phone_number, email) 
    VALUES('" . $passengerFirstName . "', '" . $passengerLastName . "', '" . $passengerPhone . "', '"
        . $passengerEmail . "')";

    $travelerID = "";

    $result = mysqli_query($connection, $qryFindTraveler);
    // check the query worked
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $travelerID = $row["route_id"];
        }

        $travelerIDList[] = $travelerID;
        $qryAddTravelerList = "INSERT INTO travelerlist(booking_id, traveler_id) VALUES('" . $bookingID . "', '"
            . $travelerID . "')";
        $result1 = mysqli_query($connection, $qryAddTravelerList);
        if (!$result1) {
            echo "Couldn't find travelers id $i";
        }
        closeDb($connection);
    } else {
        $result = mysqli_query($connection, $qryAddTraveler);
        if (!$result) {
            echo "Couldn't add traveler $i";
        } else {
            $result2 = mysqli_query($connection, $qryGetLatestID);

            if (!$result2) {
                echo "Couldn't find added travelers id $i";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $travelerID = $row["LAST_INSERT_ID()"];
                }
                $travelerIDList[] = $travelerID;
                $qryAddTravelerList = "INSERT INTO travelerlist(booking_id, traveler_id) VALUES('" . $bookingID . "', '"
                    . $travelerID . "')";
                $result3 = mysqli_query($connection, $qryAddTravelerList);
                if (!$result3) {
                    echo "Couldn't create traveler list for traveler $i";
                }

            }
        }
        closeDb($connection);
    }
}


