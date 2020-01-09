<?php

require_once __DIR__ . "/../config/database.php";

class CLIAccessLog
{
    function create()
    {
        // Hide all error
        error_reporting(0);

        // Get content file
        $path = "c:\\xampp\\apache\\logs\\";
        $filename = $path . "access.log"; // Can get another file, example : error.log
        $getsize = filesize($filename);
        if (!$getsize) {
            throw new Exception("No content inside");
        }
        $handle = fopen($filename, 'r');
        $contents = fread($handle, filesize($filename));
        fclose($handle);

        // Initialize connection datbase
        $database = new Database();
        $mysql = $database->mysql();

        // Insert access logs
        $mysql->insert("access_logs", [
            'access_log' => $contents,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        exec('httpd -k stop');

        // Delete File
        $delete = unlink($filename);
        if (!$delete) {
            throw new Exception("File not found");
        }

        $create = fopen($filename, 'w');
        chmod($filename, 0777);
        if (!$create) {
            throw new Exception("File exists");
        }

        exec('httpd -k start');

        $response = "Success save access";
        return $response;
    }

    function show() {
        // Hide all error
        error_reporting(0);

        // Get content file
        $path = "c:\\xampp\\apache\\logs\\";
        $filename = $path . "access.log"; // Can get another file, example : error.log
        $getsize = filesize($filename);
        if (!$getsize) {
            throw new Exception("No content inside");
        }
        $handle = fopen($filename, 'r');
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        
        return $contents;
    }
}
