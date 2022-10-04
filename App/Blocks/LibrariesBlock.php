<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class LibrariesBlock extends AbstractBlock
{
    public function setLibraries(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getLibraries()
    {
        return $this->models['libraries'];
    }
}
