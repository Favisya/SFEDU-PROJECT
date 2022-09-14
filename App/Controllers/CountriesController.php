<?php

namespace App\Controllers;

use App\Blocks\Block;
use App\Models\CountriesModel;

class CountriesController implements ControllerInterface
{
    public function execute()
    {
        $model = new CountriesModel();
        $data = $model->executeQuery();
        $model->setData($data);

        $block = new Block();
        $block->setModel($model);
    }
}
