<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class AuthorBlock extends AbstractBlock
{
    public function setAuthor(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getAuthor()
    {
        return $this->models['author'];
    }
}
