<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CountriesModel;

class CountriesController implements ControllerInterface
{
    public function execute()
    {
        $model = new CountriesModel();
        $model->setData();

        $block = new Block();
        $block->setModel($model);
    }
}
