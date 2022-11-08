<?php

namespace App\Controllers;

use App\Blocks\CountriesBlock;
use App\Models\Resource\BookResource;
use App\Models\Resource\CountriesResource;
use App\Models\SessionModel;
use Laminas\Di\Di;

class CountriesController extends AbstractController
{
    public function __construct(Di $di, CountriesResource $resource)
    {
        parent::__construct($di, $resource);
    }

    public function execute()
    {
        $countriesResource = $this->resource;
        $countriesResource->getCountries();
    }
}
