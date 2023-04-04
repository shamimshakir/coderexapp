<?php

namespace App\Controllers;

use App\Services\HelloService;
use Core\Request;

class HelloController extends Controller
{
    public function __construct(
        protected HelloService $helloService,
        protected $bonk = 10
    )
    {
    }

    public function index(Request $request, $id, $product_id): false|string
    {
//        dd($request, $id, $product_id, $this->helloService);
        return view('hello.view');
    }

    public function store(Request $request, $id, $product_id)
    {
        dd($id, $product_id, $this->helloService);
    }
}