<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class BookBlock extends AbstractBlock
{
    private $book;

    public function setBook(AbstractModel $models)
    {
        $this->book = $models;
    }

    public function getBook()
    {
        return $this->book;
    }
}
