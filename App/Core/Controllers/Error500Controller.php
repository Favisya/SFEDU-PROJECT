<?php

namespace App\Core\Controllers;

class Error500Controller extends AbstractController
{
    public function execute()
    {
        $this->renderPage('500', $this->block);
    }
}
