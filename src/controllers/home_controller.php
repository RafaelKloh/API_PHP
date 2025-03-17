<?php
namespace App\controllers;

class Home_controller
{
    public function index()
    {
        $data = array('message' => 'Hello World');
        echo json_encode($data);
    }
}