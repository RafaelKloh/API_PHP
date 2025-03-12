<?php

namespace App\http;

Class Response
{
    public static function json(array $data, int $status = 200)
    {
        http_response_code($status);

        header("Content-Type: aplication/json");

        echo json_encode($data);
    }
}