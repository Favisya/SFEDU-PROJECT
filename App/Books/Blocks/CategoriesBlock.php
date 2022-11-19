<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

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
