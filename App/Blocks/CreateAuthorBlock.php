<?php

namespace App\Blocks;

use App\Database\Database;

class CreateAuthorBlock extends BlockAbstract
{
    protected $template = 'createAuthor';

    public function getData(): array
    {
        return [''];
    }
}
