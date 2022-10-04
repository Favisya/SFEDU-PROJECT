<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class CountriesBlock extends AbstractBlock
{
    public function setCountries(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getCountries()
    {
        return $this->models['countries'];
    }
}
