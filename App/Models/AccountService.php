<?php

namespace App\Models;

use App\Models\SessionModel;

class AccountService
{
    public function checkPassword(string $hash, array $data): bool
    {
        $verify = password_verify($hash, $data['password']);
        if (!$verify) {
            return false;
        }

        $sessionModel = SessionModel::getInstance();
        $sessionModel->setUserData($data);

        return true;
    }
}
