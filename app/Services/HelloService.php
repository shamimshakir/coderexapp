<?php

namespace App\Services;

use App\Repositories\HelloRepository;

class HelloService
{
    public function __construct(
        protected HelloRepository $service
    )
    {
    }
}