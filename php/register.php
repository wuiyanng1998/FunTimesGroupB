<?php
/*To do list:
Put in temporary values in the database for non-essential variables
 */

if(strpos($_SERVER['HTTP_USER_AGENT'],'Mediapartners-Google') !== false) {
    exit();
}

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

    //Check that email has not been entered previously
    $checkRepeatEmail = "SELECT * FROM loginuser WHERE email='$email'";
    $result = mysqli_query($connection, $checkRepeatEmail);
    $noRepeats = mysqli_num_rows($result);

    if ($noRepeats != 0){
        echo "Sorry, email has already been registered.";
        header('location: ../errorPage.php?errorCode=5');

    } else {
        // Build the query statement
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insertLoginUser = "INSERT INTO loginuser (`email`, `password`) VALUES ('$email', '$hash')";

        // Execute the query and insert
        mysqli_query($connection, $insertLoginUser);

        $get_user_id = "SELECT user_id FROM loginuser WHERE email = '$email'";
        $result = mysqli_query($connection, $get_user_id);
        $user_id = mysqli_fetch_assoc($result)["user_id"];
        print $user_id;

        if ($identity == 'Booker'){
            echo 'WRITING BOOKER';
            //Added dummy values for variables that are not yet in the form. Look at company_id -> check if we are keeping this in updated database
            $insertBooker = "INSERT INTO booker (`first_name`, `last_name`, `phone_number`, `user_id`, `finance_allowance`, `company_id`) VALUES ('$first_name', '$last_name', '$phone_number', '$user_id', '1000', '1')";
            mysqli_query($connection, $insertBooker);
            print "<br>".$insertBooker;
        } else {
            echo 'WRITING DRIVER';
            //Added dummy values for variables that are not yet in the form
            $insertDriver = "INSERT INTO driver (`first_name`, `last_name`, `phone_number`, `user_id`, `driver_rating`) VALUES ('$first_name', '$last_name', '$phone_number', '$user_id', '4.5')";
            mysqli_query($connection, $insertDriver);
            print "<br>".$insertDriver;
            //if ($connection->query($insertDriver) === TRUE) {
            //echo "Driver created successfully <br>";
            //} else {
            //echo "Error: " . $insertDriver . "<br>" . $connection->error . "<br>";
            //}
        }

        header('location: ..\login.html');

        $connection->close();
    }



}
