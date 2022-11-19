<?php

namespace App\Account\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

class UsersBlock extends AbstractBlock
{
    private $users;

    public function setUsers(AbstractModel $models)
    {
        $this->users = $models;
    }

    public function getUsers()
    {
        return $this->users;
    }
}
