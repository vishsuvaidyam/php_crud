<?php
function connect_to_database()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo"connection succesfully";
    return $conn;
}
?>