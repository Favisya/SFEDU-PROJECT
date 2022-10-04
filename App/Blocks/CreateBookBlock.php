<?php

namespace App\Blocks;

use App\Models\AbstractModel;

class CreateBookBlock extends AbstractBlock
{
    public function setModel(AbstractModel $model)
    {
        $this->models["$model"] = $model;
    }

    public function getBook()
    {
        return $this->models['book'];
    }

    public function getCountries()
    {
        return $this->models['countries'];
    }

    public function getCategories()
    {
        return $this->models['categories'];
    }

    public function getAuthors()
    {
        return $this->models['authors'];
    }

    public function getPublishers()
    {
        return $this->models['publishers'];
    }
}
