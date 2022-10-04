<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class UserBlock extends AbstractBlock
{
    public function setUser(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getUser()
    {
        return $this->models['user'];
    }
}
