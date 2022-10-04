<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class LibraryBlock extends AbstractBlock
{
    private $library;

    public function setLibrary(AbstractModel $models)
    {
        $this->library = $models;
    }

    public function getLibrary()
    {
        return $this->library;
    }
}
