<?php

require(__DIR__ . "/service.php");

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
        return AccessLogService::softDelete($id);
    } else {
        throw new Exception($_SERVER["REQUEST_METHOD"] . " : Not allowed");
    }
} catch (\Exception $error) {
    return Response::response_message(500, 'error', $error->getMessage());
}
