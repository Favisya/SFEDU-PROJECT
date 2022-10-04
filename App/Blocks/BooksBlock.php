<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class BooksBlock extends AbstractBlock
{
    public function setBooks(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getBooks()
    {
        return $this->models['books'];
    }
}
