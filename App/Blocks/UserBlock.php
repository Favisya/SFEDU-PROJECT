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

    public function renderEmail()
    {
        require_once APP_ROOT . '/App/templates/email.phtml';
    }
}
