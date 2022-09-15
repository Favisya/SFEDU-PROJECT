<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CountriesModel;

class CountriesResource
{
    public function executeQuery()
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        $countriesModel = new CountriesModel();
        $countriesModel->setData($stmt->fetchAll());

        return $countriesModel;
    }
}
