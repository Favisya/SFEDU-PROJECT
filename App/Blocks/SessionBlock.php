<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class SessionBlock extends AbstractBlock
{
    public function setSession(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getSession()
    {
        return $this->models['session'];
    }
}
