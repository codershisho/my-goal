<?php

namespace App\Http\Controllers;

use App\Const\MessageConst;
use App\Services\Goal\IndexService;
use App\Services\Goal\ShowService;
use App\Services\Goal\StoreService;
use App\Services\Goal\UpdateService;
use Illuminate\Http\Request;

class GoalApi extends AbstractApi
{
    /**
     * t_goalsの検索
     * - 期と人に紐づくデータを返す
     *
     * @param integer $termId
     * @param IndexService $service
     * @return void
     */
    public function index(int $termId, IndexService $service)
    {
        $data = $service->execIndex($termId);
        return $this->setResponse($data, MessageConst::MESSAGE_001);
    }

    /**
     * 期に紐づくログインユーザーの目標を返す
     *
     * @param integer $term_id
     * @param ShowService $service
     * @return void
     */
    public function show(int $term_id, ShowService $service)
    {
        $data = $service->execShow($term_id);
        return $this->setResponse($data, MessageConst::MESSAGE_001);
    }

    /**
     * t_goalsの新規登録
     *
     * @param integer $term_id
     * @param Request $request
     * @param StoreService $service
     * @return void
     */
    public function store(int $term_id, Request $request, StoreService $service)
    {
        $service->execCreate($term_id, $request->all());
        return $this->setResponse(MessageConst::MESSAGE_002);
    }

    /**
     * t_goalsの更新
     *
     * @param integer $termId
     * @param Request $request
     * @param UpdateService $service
     * @return void
     */
    public function update(int $termId, Request $request, UpdateService $service)
    {
        $service->execUpdate($termId, $request->all());
        return $this->setResponseMessage(MessageConst::MESSAGE_003);
    }
}
