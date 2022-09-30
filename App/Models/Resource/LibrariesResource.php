<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorModel;
use App\Models\LibrariesModel;
use App\Models\AbstractModel;
use App\Models\LibraryModel;

class LibrariesResource
{
    public function getLibraries(): AbstractModel
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM libraries;';

        $stmt = $db->query($query);

        $librariesModel = new LibrariesModel();

        $libraries = [];
        foreach ($stmt->fetchAll() as $author) {
            $libModel = new LibraryModel();
            $libModel->setData($author);
            $libraries[] = $libModel;
        }
        $librariesModel->setData($libraries);

        return $librariesModel;
    }
}
