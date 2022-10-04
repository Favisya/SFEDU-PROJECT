<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class AuthorsBlock extends AbstractBlock
{
    public function setAuthors(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getAuthors()
    {
        return $this->models['authors'];
    }
}
