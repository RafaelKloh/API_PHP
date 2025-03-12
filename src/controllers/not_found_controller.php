<?php

namespace App\controllers;
use App\http\Request;
use App\http\Response;

Class Not_found_controller
{
    public function index(Request $request, Response $reponse)
    {
        $reponse::json([
            'error' => true,
            'success' => false,
            'mesage' => 'Sorry, route not foud'
        ], 404);
        return;
    }
}