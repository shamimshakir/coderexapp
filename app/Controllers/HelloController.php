<?php

namespace App\Controllers;

class HelloController extends Controller
{
    public function index(): false|string
    {
        dd(config('app'));
        return view('hello.view');
    }
}