<?php

namespace App\Controllers;

use Core\Request;

class HelloController extends Controller
{
    public function index(Request $request): false|string
    {
        dd($request);
        return view('hello.view');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}