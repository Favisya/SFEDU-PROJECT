<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
