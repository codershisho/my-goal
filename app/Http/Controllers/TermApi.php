<?php

namespace App\Http\Controllers;

use App\Services\Term\IndexService;
use Illuminate\Http\Request;

class TermApi extends AbstractApi
{
    /**
     * 期の一覧を返す
     *
     * @param IndexService $service
     * @return void
     */
    public function index(IndexService $service)
    {
        $data = $service->execIndex();
        return $this->setResponse($data);
    }
}
