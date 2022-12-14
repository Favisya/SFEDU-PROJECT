<?php

namespace App\Core\Models;

use App\Core\Models\Resource\AbstractResource;
use Laminas\Di\Di;

abstract class AbstractService
{
    protected $resource;
    protected $session;

    public function getResource(): ?AbstractResource
    {
        return $this->resource;
    }

    public function setResource(AbstractResource $resource): void
    {
        $this->resource = $resource;
    }
}
