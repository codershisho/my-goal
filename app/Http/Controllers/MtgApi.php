<?php

namespace App\Http\Controllers;

use App\Http\Requests\MtgStoreRequest;
use App\Services\Mtg\StoreService;
use Illuminate\Http\Request;

/**
 * 面談API
 */
class MtgApi extends AbstractApi
{
    public function index()
    {
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
