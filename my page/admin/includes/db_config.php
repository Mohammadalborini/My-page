<?php

$db_host = 'localhost';
$db_user = 'id20242652_mohammadmypage';
$db_pass = 'gcOCjj*Ys8bNcgeG';
$db_name = 'id20242652_mypage';

//connect to db
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// check connection
if ($conn->connect_error) {
    die( 'Connection failed: ' . $conn->connect_error );
}

define('APP_NAME', 'ADMIN');


?>