<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CountriesModel;
use App\Models\Resource\CountriesResource;

class CountriesController extends AbstractController
{
    public function execute()
    {
        $countriesResource = new CountriesResource();
        $countriesResource->executeQuery();
    }
}
