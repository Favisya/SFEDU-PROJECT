<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class LibrariesBlock extends AbstractBlock
{
    private $libraries;

    public function setLibraries(AbstractModel $models)
    {
        $this->libraries = $models;
    }

    public function getLibraries()
    {
        return $this->libraries;
    }
}
