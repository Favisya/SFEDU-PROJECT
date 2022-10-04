<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class CountriesBlock extends AbstractBlock
{
    private $countries;

    public function setCountries(AbstractModel $models)
    {
        $this->countries = $models;
    }

    public function getCountries()
    {
        return $this->countries;
    }
}
