<?php

namespace App\Blocks;

use App\Models\ModelAbstract;

class Block
{
    protected $template;
    protected $model = [];

    public function render()
    {
        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function setModel(ModelAbstract $model)
    {
        $this->model = $model;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }
}
