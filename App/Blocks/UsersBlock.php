<?php

namespace App\Blocks;

use App\Models\AbstractModel;

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
