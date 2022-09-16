<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class Block
{
    protected $template;
    protected $model = [];

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function setModel(AbstractModel $model)
    {
        $this->model = $model;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }
}
