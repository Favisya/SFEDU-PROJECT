<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
