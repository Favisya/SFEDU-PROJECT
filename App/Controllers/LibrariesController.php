<?php

namespace App\Controllers;

use App\Models\Resource\LibrariesResource;

class LibrariesController extends AbstractController
{
    public function execute()
    {
        $librariesResource = new LibrariesResource();
        $librariesModel = $librariesResource->executeQuery();

        $this->commonExecute('libraries', $librariesModel);
    }
}
