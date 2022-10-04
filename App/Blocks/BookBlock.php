<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class BookBlock extends AbstractBlock
{
    public function setBook(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getBook()
    {
        return $this->models['book'];
    }
}
