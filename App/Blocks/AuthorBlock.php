<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class AuthorBlock extends AbstractBlock
{
    private $author;

    public function setAuthor(AbstractModel $models)
    {
        $this->author = $models;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}
