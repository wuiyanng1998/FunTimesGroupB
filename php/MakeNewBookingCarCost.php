<?php

require_once('phpDatabaseConnection.php');


function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

// Typically, this would be a call to a database
function calculateTravelCost($travelTime)
{
    $costsArrays = [];
    $connection = connectToDb();
    $qryCarsCost = "SELECT DISTINCT vehicle_name, vehicle_cost FROM vehicle";
    if ($carsCost = mysqli_query($connection, $qryCarsCost)) {
        while ($car = mysqli_fetch_assoc($carsCost)) {
            $tripCost = $travelTime * $car['vehicle_cost'];
            $carCosts = [
                "name" => $car['vehicle_name'],
                "carCost" => $tripCost
            ];
            $costsArrays[] = $carCosts;
        }
        return $costsArrays;
    } else {
        print "Error with car cost json encoding";
    }
}

if (!is_ajax_request()) {
    exit;
}

$travelTime = isset($_GET['q']) ? (int)$_GET['q'] : 1;

$costsArrays = calculateTravelCost($travelTime);

echo json_encode($costsArrays);

//foreach ($costsArrays as $carCosts) {
//    echo $carCosts["name"], $carCosts["carCost"];
//}



