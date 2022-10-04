<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class CategoriesBlock extends AbstractBlock
{
    private $categories;

    public function setCategories(AbstractModel $models)
    {
        $this->categories = $models;
    }

    public function getCategories()
    {
        return $this->categories;
    }
}
