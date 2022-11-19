<?php

namespace App\Account\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
