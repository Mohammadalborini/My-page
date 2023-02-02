<?php

$db_host = 'sql202.epizy.com';
$db_user = 'epiz_33505234';
$db_pass = 'M6xlx2Z6Pc';
$db_name = 'epiz_33505234_Mypage';

//connect to db
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// check connection
if ($conn->connect_error) {
    die( 'Connection failed: ' . $conn->connect_error );
}

define('APP_NAME', 'ADMIN');


?>