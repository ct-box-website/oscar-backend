<?php

// $db_host = "localhost"; 
$db_host = "localhost";
$db_user = "chenter";
$db_pass = "c.ter.app@123";

$db_name = "crud_db";


# Create connection
// $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
