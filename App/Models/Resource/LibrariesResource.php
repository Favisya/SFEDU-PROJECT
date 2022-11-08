<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorModel;
use App\Models\LibrariesModel;
use App\Models\AbstractModel;
use App\Models\LibraryModel;

class LibrariesResource extends AbstractResource
{
    public function getLibraries(): AbstractModel
    {
        $db = $this->di->get(Database::class);
        $db = $db->getConnection();

        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        $librariesModel = $this->di->get(LibrariesModel::class);

        $libraries = [];
        foreach ($stmt->fetchAll() as $author) {
            $libModel = $this->di->newInstance(LibraryModel::class);
            $libModel->setData($author);
            $libraries[] = $libModel;
        }
        $librariesModel->setData($libraries);

        return $librariesModel;
    }
}
