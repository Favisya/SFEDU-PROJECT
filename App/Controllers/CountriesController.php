<?php

namespace App\Controllers;

use App\Blocks\CountriesBlock;

class CountriesController implements ControllerInterface
{
    public function execute()
    {
        $block = new CountriesBlock();
        $block->setData();
    }
}
