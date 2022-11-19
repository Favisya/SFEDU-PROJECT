<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

class BooksBlock extends AbstractBlock
{
    private $books;

    public function setBooks(AbstractModel $models)
    {
        $this->books = $models;
    }

    public function getBooks()
    {
        return $this->books;
    }
}
