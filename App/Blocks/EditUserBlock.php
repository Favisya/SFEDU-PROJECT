<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class EditUserBlock extends AbstractBlock
{
    public function setSession(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function setUser(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getUser()
    {
        return $this->models['user'];
    }

    public function getSession()
    {
        return $this->models['session'];
    }
}
