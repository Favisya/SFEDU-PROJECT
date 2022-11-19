<?php

namespace App\Books\Controllers\Console;

use App\Core\Models\Resource\Environment;
use App\Core\Controllers\Console\AbstractController;
use App\Books\Models\Resource\UpdateBooksResource;
use App\Core\Models\SessionModel;
use App\Core\Models\TokenModel;

class NewBooksController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UpdateBooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $this->resource->parseNewBooks();
    }
}
