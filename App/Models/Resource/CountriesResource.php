<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CountriesModel;
use App\Models\ModelAbstract;

class CountriesResource
{
    public function executeQuery(): ModelAbstract
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        $countriesModel = new CountriesModel();
        $countriesModel->setData($stmt->fetchAll());

        return $countriesModel;
    }
}
