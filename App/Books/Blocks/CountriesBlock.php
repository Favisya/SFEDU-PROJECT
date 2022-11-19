<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
