<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class UserBlock extends AbstractBlock
{
    private $user;

    public function setUser(AbstractModel $models)
    {
        $this->user = $models;
    }

    public function getUser()
    {
        return $this->user;
    }
}
