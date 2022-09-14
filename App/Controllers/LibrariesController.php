<?php

namespace App\Controllers;

use App\Models\LibrariesModel;
use App\Models\Resource\LibrariesResource;

class LibrariesController extends AbstractController
{
    public function execute()
    {
        $librariesModel = new LibrariesModel();
        $librariesResource = new LibrariesResource();

        $data = $librariesResource->executeQuery();
        $librariesModel->setData($data);

        $this->commonExecute('libraries', $librariesModel);
    }
}
