<?php

namespace App\Account\Blocks;

use App\Core\Models\SessionModel;
use App\Core\Blocks\AbstractBlock;

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
