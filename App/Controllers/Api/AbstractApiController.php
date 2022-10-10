<?php

namespace App\Controllers\Api;

use App\Controllers\AbstractController;

abstract class AbstractApiController extends AbstractController
{
    protected $param;

    public function __construct($param = null)
    {
        $this->param = $param;
    }
}
