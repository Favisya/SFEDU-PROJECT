<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\CountriesModel;
use App\Models\AbstractModel;

class CountriesResource extends AbstractResource
{
    public function getCountries(): AbstractModel
    {
        $db = $this->database->getConnection();

        $query = 'SELECT * from countries;';
        $stmt  = $db->query($query);

        $countriesModel = $this->di->get(CountriesModel::class);
        $countriesModel->setData($stmt->fetchAll());

        return $countriesModel;
    }
}
