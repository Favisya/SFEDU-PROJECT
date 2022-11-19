<?php

namespace App\Account\Controllers;

use App\Account\Models\Resource\ClientsBooksResource;
use App\Core\Controllers\AbstractController;
use App\Core\Models\Resource\Environment;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class TakeBookController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        ClientsBooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $session = $this->session;
        $this->resource->takeBook($this->getParam('id'), $session->getUserId());
        $this->redirect('books');
    }
}
