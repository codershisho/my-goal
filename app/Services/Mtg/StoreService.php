<?php

namespace App\Services\Mtg;

use App\Http\Requests\MtgStoreRequest;
use App\Interfaces\IMtgRepository;

/**
 * 面談作成処理
 */
class StoreService
{
    private $repo;

    public function __construct(IMtgRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execStore(MtgStoreRequest $request)
    {
        $model = [
            "mtg_date" => $request->mtg_date,
            "status" => $request->status,
            "from_user_id" => $request->from_user_id,
            "to_user_id" => $request->to_user_id,
        ];

        // t_mtgsの登録
        $mtg = $this->repo->storeMtg($model);
        $mtgId = $mtg->id;

        // t_mtg_detailの登録
        $request->collect('details')->each(function ($detail) use ($mtgId) {
            $this->repo->storeMtgDetail($mtgId, $detail);
        });
    }
}
