<?php

namespace App\Blocks;

use App\Models\SessionModel;

class SessionBlock extends AbstractBlock
{
    protected $session;

    public function setSession(SessionModel $models)
    {
        $this->session = $models;
    }

    public function getSession()
    {
        return $this->session;
    }
}
