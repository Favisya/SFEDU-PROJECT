<?php

namespace App\Books\Models\Resource;

use App\Core\Models\Resource\AbstractResource;
use App\Books\Models\CountriesModel;
use App\Core\Models\AbstractModel;

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
