<?php

class Response
{
    function response_message($code, $status, $message)
    {
        http_response_code($code);
        $response = [
            "code" => $code,
            "status" => $status,
            "message" => $message
        ];
        echo json_encode($response);
    }

    function response_data($code, $status, $message, $data)
    {
        http_response_code($code);
        $response = [
            "code" => $code,
            "status" => $status,
            "message" => $message,
            "data" => $data
        ];
        echo json_encode($response);
    }
}
