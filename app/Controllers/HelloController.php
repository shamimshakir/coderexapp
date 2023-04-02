<?php

namespace App\Controllers;

class HelloController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        return view('hello.view');
    }
}