<?php

namespace App\Http\Controllers;

use App\Services\User\IndexService;
use Illuminate\Http\Request;

class UserApi extends AbstractApi
{

    public function index(IndexService $service)
    {
        $data = $service->execIndex();
        return $this->setResponse($data, "検索完了");
    }
}
