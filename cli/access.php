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
        $parser = new \Kassner\LogParser\LogParser();
        $parser->setFormat("%h %l %u %t \"%r\" %>s %b \"%{Referer}i\" \"%{User-agent}i\"");
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Initialize connection datbase
        $database = new Database();
        $mysql = $database->mysql();

        foreach ($lines as $line) {
            $entry = $parser->parse($line);
            // Insert access logs
            $mysql->insert("access_logs", [
                "stampt" => $entry->stamp,
                "host" => $entry->host,
                "logname" => $entry->logname,
                "user" => $entry->user,
                "time" => $entry->time,
                "request" => $entry->request,
                "status" => $entry->status,
                "respond_bytes" => $entry->responseBytes,
                "header_referer" => $entry->HeaderReferer,
                "header_useragent" => $entry->HeaderUseragent,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

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
        return $entry;
    }

    function show()
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

        return $contents;
    }
}
