<?php
// Establish a connection to a MySQL database
$db_connection = mysqli_connect("localhost", "root", "", "oop_db");

// Check connection
if (mysqli_connect_errno()) {
    // Display an error message if there is an error in connecting to the database
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}