<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
