<?php

require_once(__DIR__ . "/../../config/database.php");

$database = new Database();
$mysql = $database->mysql();

// Drop all 
$mysql->drop("user_details");
$mysql->drop("users");
$mysql->drop("access_logs");

if (!$mysql) {
    throw new Exception(error_get_last());
}
