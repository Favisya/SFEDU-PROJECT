<?php

namespace App\Core\Models;

class TokenModel extends AbstractModel
{
    public function generateToken()
    {
        return hash('sha256', random_bytes(16));
    }
}
