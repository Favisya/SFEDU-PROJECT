<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CountriesModel;
use App\Models\Resource\CountriesResource;

class CountriesController extends AbstractController
{
    public function execute()
    {
        $countriesModel = new CountriesModel();
        $countriesResource = new CountriesResource();

        $data = $countriesResource->executeQuery();
        $countriesModel->setData($data);
    }
}
