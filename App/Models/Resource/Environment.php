<?php

namespace App\Models\Resource;

class Environment
{
    protected $settings;

    public function __construct()
    {
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
    }

    public function getDatabase()
    {
        return $this->settings['DATABASE'];
    }

    public function getUri()
    {
        return $this->settings['URI'];
    }
}
