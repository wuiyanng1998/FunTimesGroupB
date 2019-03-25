<?php
//Include the credentials
require_once('dbCredentials.php');
//require_once('dbCredentialsFei.php');

//Connect to database (no error handling)
//$connection = mysqli_connect('localhost','phpuser','basics','phpbasics');

//Connect to a database with error handling
function connectToDb()
{
    $connection = mysqli_connect(DBSERVER, DBUSER, DBPASSWORD, DBNAME);
    validateConnection();
    return $connection;
}

//Validate the database connection else return the error number and message
function validateConnection()
{
    if (mysqli_connect_errno()) {
        $msg = "Error: Unable to connect to MySQL database: ";
        $msg .= mysqli_connect_errno();
        $msg .= mysqli_connect_error();
        exit($msg);
    }
}

//Close the connection to the database
function closeDb($connection)
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

connectToDb();
