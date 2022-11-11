<?php

namespace App\Controllers;

use App\Models\Resource\CountriesResource;
use App\Models\Resource\Environment;
use App\Models\SessionModel;
use App\Models\TokenModel;

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
