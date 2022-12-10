<?php 
    //start session
    session_start();

    // Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/japanese-restaurant/');
    define('LOCALHOST', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'food-order');


    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // selecting database
?>