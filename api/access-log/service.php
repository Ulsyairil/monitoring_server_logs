<?php

require(__DIR__ . "/../../helpers/response.helper.php");
require(__DIR__ . "/../../config/access.php");
require(__DIR__ . "/../../config/database.php");

class AccessLogService
{
    function show()
    {
        // Initialize connection datbase
        $database = new Database();
        $mysql = $database->mysql();

        $count = $mysql->count("access_logs", [
            "deleted_at" => null
        ]);

        if ($count > 0) {
            $data = $mysql->select("access_logs", [
                "id",
                "access_log",
                "created_at"
            ], [
                "deleted_at" => null
            ]);

            return Response::response_data(200, 'success', 'success get data', $data);
        } else {
            throw new Exception("No data find");
        }
    }

    function softDelete($id)
    {
        // Initialize connection datbase
        $database = new Database();
        $mysql = $database->mysql();

        $count = $mysql->count("access_logs", [
            "id" => $id
        ]);

        if ($count > 0) {
            $mysql->update("access_logs", [
                "deleted_at" => date('Y-m-d H:i:s')
            ], [
                "id" => $id
            ]);
            return Response::response_message(200, 'success', 'success delete data');
        } else {
            throw new Exception("No data find");
        }
    }
}
