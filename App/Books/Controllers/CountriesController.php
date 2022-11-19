<?php

namespace App\Books\Controllers;

use App\Books\Models\Resource\CountriesResource;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class CountriesController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        CountriesResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }
    public function execute()
    {
        $countriesResource = $this->resource;
        $countriesResource->getCountries();
    }
}
