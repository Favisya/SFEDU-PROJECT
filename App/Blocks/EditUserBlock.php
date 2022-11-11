<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class EditUserBlock extends AbstractBlock
{
    protected $session;
    private $user;

    public function setSession(AbstractModel $models)
    {
        $this->session = $models;
    }

    public function setUser(AbstractModel $models)
    {
        $this->user = $models;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getSession()
    {
        return $this->session;
    }
}
