<?php
/*To do list:
Put in temporary values in the database for non-essential variables
 */
require_once('phpDatabaseConnection.php');

//if ($_POST["type"] == 1){
//    createNewAccount();
//}

createNewAccount();

function createNewAccount()
{
    //Establish connection
    $connection = connectToDb();

    //Post all relevant variables
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $identity = $_POST['myIdentity'];
    $phone_number = $_POST['phoneNumber'];

    //Check all variables posted correctly
    echo "Successful posting: " . $first_name . "," . $last_name . "," . $email . "," . $password . "," . $identity . "<br>";

// Build the query statement
    $insertLoginUser = "INSERT INTO loginuser (`email`, `password`) VALUES ('$email', '$password')";

    // Execute the query and insert
    mysqli_query($connection, $insertLoginUser);

    if ($connection->query($insertLoginUser) === TRUE) {
        echo "Login user created successfully <br>";
        $get_user_id = "SELECT user_id FROM loginuser WHERE email = '$email'";
        $result = mysqli_query($connection, $get_user_id);
        $user_id = mysqli_fetch_assoc($result)["user_id"];

    } else {
        echo "Error: " . $insertLoginUser . "<br>" . $connection->error . "<br>";
    }

    if ($identity == 'Booker'){
        //Added dummy values for variables that are not yet in the form. Look at company_id -> check if we are keeping this in updated database
        $insertBooker = "INSERT INTO booker (`first_name`, `last_name`, `phone_number`, `user_id`, `finance_allowance`, `title`) VALUES ('$first_name', '$last_name', '$phone_number', '$user_id', '10000', 'Mister')";
        mysqli_query($connection, $insertBooker);

        if ($connection->query($insertBooker) === TRUE) {
            echo "Booker created successfully <br>";
        } else {
            echo "Error: " . $insertBooker . "<br>" . $connection->error . "<br>";
        }

    } else {
        //Added dummy values for variables that are not yet in the form
        $insertDriver = "INSERT INTO driver (`first_name`, `last_name`, `phone_number`, `user_id`, `license_type`, `working_time_slot`, `driver_rating`, `title`) VALUES ('$first_name', '$last_name', '$phone_number', '$user_id', 'A', '1', '4.5', 'Mister')";
        mysqli_query($connection, $insertDriver);

        if ($connection->query($insertDriver) === TRUE) {
            echo "Driver created successfully <br>";
        } else {
            echo "Error: " . $insertDriver . "<br>" . $connection->error . "<br>";
        }
    }

    $connection->close();
}
