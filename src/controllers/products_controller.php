<?php

namespace App\controllers;

use App\http\Request;
use App\http\Response;
use App\services\Products_service;

class Products_controller
{
    public function store(Request $request, Response $response)
    {
        $body = $request::body();
        $products_services = products_service::create($body);

        if(isset($products_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $products_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'data' => $products_services
        ], 201); 
    }

    public function fetch(Request $request, Response $response)
    {
        $authorization = $request::authorization();
        $body = $request::body();

        $product_name = $body['name'] ?? '';  // Captura o nome do produto


        $products_services = Products_service::fetch($authorization,$product_name);

        if(isset($products_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $products_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'jwt' => $products_services
        ], 200);
        return;
    }

    public function update(Request $request, Response $response)
    {
        $authorization = $request::authorization();
        $body = $request::body();
        $products_services = Products_service::update($authorization, $body);

        if(isset($products_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $products_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'message' => $products_services
        ], 200);
        return;
    }

    public function remove(Request $request, Response $response, array $id)
    {
        $authorization = $request::authorization();
        $products_services = Products_service::delete($authorization, $id[0]);

        if(isset($products_services['error'])){
            return $response::json([
                'error' => true,
                'success' => false,
                'mesage' => $products_services['error']
            ],400);
        }

        $response::json([
            'error' => false,
            'success' => true,
            'message' => $products_services
        ], 200);
        return;
    }
}