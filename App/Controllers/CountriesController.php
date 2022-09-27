<?php

namespace App\Controllers;

use App\Models\Resource\CountriesResource;

class CountriesController extends AbstractController
{
    public function execute()
    {
        $countriesResource = new CountriesResource();
        $countriesResource->getCountries();
    }
}
