<?php

namespace App\Blocks;

use App\Database\Database;

class CreateBookBlock extends BlockAbstract
{
    protected $template = 'createBook';

    public function render()
    {
        $authors     = new AuthorsBlock();
        $countries   = new CountriesBlock();
        $publishers  = new PublishersBlock();

        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [''];
    }
}
