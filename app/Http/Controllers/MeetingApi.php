<?php

namespace App\Http\Controllers;

use App\Const\MessageConst;
use App\Http\Requests\MtgStoreRequest;
use App\Services\Mtg\IndexService;
use App\Services\Mtg\BaseSerivice;
use App\Services\Mtg\DetailService;
use App\Services\Mtg\StoreService;
use App\Services\Mtg\UpdateService;

/**
 * 面談API
 */
class MeetingApi extends AbstractApi
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
        return $this->setResponse($data, MessageConst::MESSAGE_001);
    }

    /**
     * t_mtgの情報を返す
     *
     * @param [type] $id
     * @param BaseSerivice $service
     * @return void
     */
    public function base($id, BaseSerivice $service)
    {
        $data = $service->execBase($id);
        return $this->setResponse($data, MessageConst::MESSAGE_001);
    }

    /**
     * t_mtg_detailの情報をトピック付きで返す
     *
     * @param [type] $id
     * @param DetailService $service
     * @return void
     */
    public function detail($id, DetailService $service)
    {
        $data = $service->execDetail($id);
        return $this->setResponse($data);
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
        $service->execStore($request->all());
        return $this->setResponseMessage(MessageConst::MESSAGE_002);
    }

    /**
     * 面談の更新
     *
     * @param MtgStoreRequest $request
     * @param UpdateService $service
     * @return void
     */
    public function update(MtgStoreRequest $request, UpdateService $service)
    {
        $service->execUpdate($request->all());
        return $this->setResponseMessage(MessageConst::MESSAGE_003);
    }
}
