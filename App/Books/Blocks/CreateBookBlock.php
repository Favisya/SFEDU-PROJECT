<?php

namespace App\Books\Blocks;

use App\Core\Models\AbstractModel;
use App\Core\Blocks\AbstractBlock;

class CreateBookBlock extends AbstractBlock
{
    private $book;
    private $countries;
    private $categories;
    private $authors;
    private $publishers;

    public function setModel(AbstractModel $model)
    {
        $this->models["$model"] = $model;
    }

    public function setBook(AbstractModel $model)
    {
        $this->book = $model;
    }

    public function setCategories(AbstractModel $model)
    {
        $this->categories = $model;
    }

    public function setCountries(AbstractModel $model)
    {
        $this->countries = $model;
    }

    public function setAuthors(AbstractModel $model)
    {
        $this->authors = $model;
    }

    public function setPublishers(AbstractModel $model)
    {
        $this->publishers = $model;
    }

    public function getBook()
    {
        return $this->book;
    }

    public function getCountries()
    {
        return $this->countries;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getAuthors()
    {
        return $this->authors;
    }

    public function getPublishers()
    {
        return $this->publishers;
    }
}
