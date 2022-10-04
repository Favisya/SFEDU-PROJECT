<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class CategoriesBlock extends AbstractBlock
{
    public function setCategories(AbstractModel $models)
    {
        $this->models["$models"] = $models;
    }

    public function getCategories()
    {
        return $this->models['categories'];
    }
}
