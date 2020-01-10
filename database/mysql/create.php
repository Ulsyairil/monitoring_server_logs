<?php

require_once(__DIR__ . "/../../config/database.php");

$database = new Database();
$mysql = $database->mysql();

// // Create table users
// $mysql->create("users", [
//     "id" => [
//         "BIGINT",
//         "NOT NULL",
//         "AUTO_INCREMENT",
//         "PRIMARY KEY"
//     ],
//     "nik" => [
//         "VARCHAR(6)",
//     ],
//     "username" => [
//         "VARCHAR(255)",
//         "NOT NULL"
//     ],
//     "password" => [
//         "TEXT",
//         "NOT NULL"
//     ],
//     "created_at" => [
//         "DATETIME",
//         "NOT NULL"
//     ],
//     "updated_at" => [
//         "DATETIME"
//     ],
//     "deleted_at" => [
//         "DATETIME"
//     ]
// ]);

// // Create table user_details
// $mysql->create("user_details", [
//     "id" => [
//         "BIGINT",
//         "NOT NULL",
//         "AUTO_INCREMENT",
//         "PRIMARY_KEY"
//     ],
//     "user_id" => [
//         "BIGINT",
//         "NOT NULL",
//         "UNIQUE"
//     ],
//     "gender" => [
//         "ENUM('pria','wanita')",
//         "NOT NULL"
//     ],
//     "address" => [
//         "TEXT"
//     ],
//     "phone_number" => [
//         "VARCHAR(13)",
//         "NOT NULL"
//     ],
//     "office_number" => [
//         "VARCHAR(13)"
//     ],
//     "created_at" => [
//         "DATETIME",
//         "NOT NULL"
//     ],
//     "updated_at" => [
//         "DATETIME"
//     ],
//     "deleted_at" => [
//         "DATETIME"
//     ],
//     "FOREIGN KEY(<user_id>) REFERENCES users(<id>)"
// ]);

// Create table access_log
$mysql->create("access_logs", [
    "id" => [
        "BIGINT",
        "NOT NULL",
        "AUTO_INCREMENT",
        "PRIMARY KEY"
    ],
    "stampt" => [
        "TEXT",
        "NOT NULL"
    ],
    "host" => [
        "TEXT",
        "NOT NULL"
    ],
    "logname" => [
        "TEXT",
        "NOT NULL"
    ],
    "user" => [
        "TEXT",
        "NOT NULL"
    ],
    "time" => [
        "TEXT",
        "NOT NULL"
    ],
    "request" => [
        "TEXT",
        "NOT NULL"
    ],
    "status" => [
        "TEXT",
        "NOT NULL"
    ],
    "respond_bytes" => [
        "TEXT",
        "NOT NULL"
    ],
    "header_referer" => [
        "TEXT",
        "NOT NULL"
    ],
    "header_useragent" => [
        "TEXT",
        "NOT NULL"
    ],
    "created_at" => [
        "DATETIME",
        "NOT NULL"
    ],
    "deleted_at" => [
        "DATETIME"
    ]
]);

// Check create fail
if (!$mysql) {
    throw new Exception(error_get_last());
}
