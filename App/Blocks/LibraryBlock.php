<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class LibraryBlock extends AbstractBlock
{
    public function setLibrary(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getLibrary()
    {
        return $this->models['library'];
    }
}
