<?php

namespace App\Http\Controllers;

use App\Services\Topic\IndexService;
use Illuminate\Http\Request;

/**
 * トピックAPIクラス
 */
class TopicApi extends AbstractApi
{
    /**
     * トピック情報を返す
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
