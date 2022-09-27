<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CountriesModel;
use App\Models\AbstractModel;

class CountriesResource
{
    public function getCountries(): AbstractModel
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        $countriesModel = new CountriesModel();
        $countriesModel->setData($stmt->fetchAll());

        return $countriesModel;
    }
}
