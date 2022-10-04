<?php

namespace App\Blocks;

use App\Models\AbstractModel;

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
