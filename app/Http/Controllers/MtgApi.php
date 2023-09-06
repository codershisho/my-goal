<?php

namespace App\Http\Controllers;

use App\Http\Requests\MtgStoreRequest;
use App\Services\Mtg\IndexService;
use App\Services\Mtg\ShowSerivice;
use App\Services\Mtg\StoreService;

/**
 * 面談API
 */
class MtgApi extends AbstractApi
{
    /**
     * 面談一覧検索
     *
     * @param IndexService $service
     * @return void
     */
    public function index(IndexService $service)
    {
        $data = $service->execIndex();
        return $this->setResponse($data, "検索完了");
    }

    /**
     * 面談の詳細情報検索
     *
     * @param [type] $id
     * @param ShowSerivice $service
     * @return void
     */
    public function show($id, ShowSerivice $service)
    {
        $data = $service->execShow($id);
        return $this->setResponse($data, "検索完了");
    }

    /**
     * 面談作成
     *
     * @param MtgStoreRequest $request
     * @param StoreService $service
     * @return void
     */
    public function store(MtgStoreRequest $request, StoreService $service)
    {
        $service->execStore($request);
        return $this->setResponseMessage("登録完了");
    }
}
