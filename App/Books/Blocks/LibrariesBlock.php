<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
