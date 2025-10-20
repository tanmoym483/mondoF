<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'message' => 'Welcome to the Food E-commerce Dashboard!'
        ];

        return $this->render('home', $data);
    }
}
