<?php

namespace App\Http\Controllers;

use App\Services\Goal\IndexService;
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
        return $this->setResponse($data, "検索完了");
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
        // TODO FormRequestクラスの定義追加
        $service->execUpdate($termId, $request);
        return $this->setResponseMessage("更新完了");
    }
}
