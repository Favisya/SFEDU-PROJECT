<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

class AuthorsBlock extends AbstractBlock
{
    private $authors;

    public function setAuthors(AbstractModel $models)
    {
        $this->authors = $models;
    }

    public function getAuthors()
    {
        return $this->authors;
    }
}
