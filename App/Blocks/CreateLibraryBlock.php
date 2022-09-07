<?php

namespace App\Blocks;

use App\Database\Database;

class CreateLibraryBlock extends BlockAbstract
{
    protected $template = 'createLibrary';

    public function getData(): array
    {
        return [''];
    }
}
