<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class EmailBlock extends AbstractBlock
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

    public function render(): string
    {
        ob_start();
        require_once APP_ROOT . '/App/templates/' . $this->template . '.phtml';
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}