<?php

namespace App\Blocks;


class CreateBookBlock extends BlockAbstract
{
    private $countries  = [];
    private $publishers = [];
    private $authors    = [];

    protected $template = 'createBook';

    public function setCountries()
    {
        $block = new CountriesBlock();
        $block->setData();
        $this->countries = $block->getData();
    }

    public function setPublishers()
    {
        $block = new PublishersBlock();
        $block->setData();
        $this->publishers = $block->getData();
    }

    public function setAuthors()
    {
        $block = new AuthorsBlock();
        $block->setData();
        $this->authors = $block->getData();
    }

    public function getCountries(): array
    {
        return $this->countries;
    }

    public function getPublishers(): array
    {
        return $this->publishers;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }
}
