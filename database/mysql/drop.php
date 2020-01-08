<?php

require(__DIR__ . "/../../config/database.php");
require(__DIR__ . "/../../helpers/response.helper.php");

try {
    $database = new Database();
    $mysql = $database->mysql();

    // Drop all 
    $mysql->drop("user_details");
    $mysql->drop("users");
    $mysql->drop("access_logs");

    // Check drop fail
    if (!$mysql) {
        throw new Exception($mysql->error_get_last());
    }

    return Response::response(200, "success", "success drop table");
} catch (\Exception $error) {
    return Response::response_data(500, "error", "error when drop table", $error->getMessage());
}
