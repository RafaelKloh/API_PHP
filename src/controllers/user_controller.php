<?php

namespace App\controllers;

use App\http\Request;
use App\http\Response;
use App\services\User_service;

class user_controller
{
    public function store(Request $request, Response $response)
    {
        $body = $request::body();
        $user_services = user_service::create($body);

        if(isset($user_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $user_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'data' => $user_services
        ], 201);
    }

    public function login(Request $request, Response $response)
    {
        $body = $request::body();
        $user_services = user_service::auth($body);

        if(isset($user_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $user_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'jwt' => $user_services
        ], 200);
        return;
    }

    public function fetch(Request $request, Response $response)
    {
        $authorization = $request::authorization();

        $user_services = user_service::fetch($authorization);

        if(isset($user_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $user_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'jwt' => $user_services
        ], 200);
        return;
    }

    public function update(Request $request, Response $response)
    {
        $authorization = $request::authorization();
        $body = $request::body();
        $user_services = user_service::update($authorization, $body);

        if(isset($user_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $user_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'message' => $user_services
        ], 200);
        return;
    }

    public function remove(Request $request, Response $response, array $id)
    {
        $authorization = $request::authorization();
        $user_services = user_service::delete($authorization, $id[0]);

        if(isset($user_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $user_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'message' => $user_services
        ], 200);
        return;
    }
}