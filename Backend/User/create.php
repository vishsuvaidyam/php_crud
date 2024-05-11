<?php

require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $DB = connect_to_database();
    
    $sql_create = "INSERT INTO user ( name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
    $success = mysqli_query($DB, $sql_create);
    if (!$success) {
        echo "Error: " . mysqli_error($DB);
    } else {
        echo "Record inserted successfully!";
        header("Location:../../Frontend/table.php");
        exit();
    }
    // $DB->close();
} else {
    echo "Invalid request";
    
}

?>
