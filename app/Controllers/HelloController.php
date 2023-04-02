<?php

namespace App\Controllers;

class HelloController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(): false|string
    {
        return view('hello.view');
    }
}