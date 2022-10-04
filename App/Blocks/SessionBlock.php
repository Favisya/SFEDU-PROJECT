<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class SessionBlock extends AbstractBlock
{
    private $session;

    public function setSession(AbstractModel $models)
    {
        $this->session = $models;
    }

    public function getSession()
    {
        return $this->session;
    }
}
