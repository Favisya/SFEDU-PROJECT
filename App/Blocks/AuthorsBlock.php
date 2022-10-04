<?php

namespace App\Blocks;

use App\Models\AbstractModel;

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
