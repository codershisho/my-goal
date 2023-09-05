<?php

namespace App\Services\Mtg;

use App\Http\Requests\MtgStoreRequest;
use App\Interfaces\IMtgRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();

            $model = [
                "mtg_date" => $request->mtg_date,
                "status" => 0,
                "from_user_id" => Auth::id(),
                "to_user_id" => $request->to_user_id,
            ];

            $exist = $this->repo->duplicateMtg($model);
            if ($exist) {
                throw new Exception('すでにデータが存在しています');
            }

            // t_mtgsの登録
            $mtg = $this->repo->storeMtg($model);
            $mtgId = $mtg->id;

            // t_mtg_detailの登録
            $request->collect('topics')->each(function ($detail) use ($mtgId) {
                $model = [
                    "mtg_id" => $mtgId,
                    "topic_id" => $detail['topic_id'],
                    "topic_detail_id" => $detail['selected'] ?? 1,
                    "from_memo" => $detail['from_memo'] ?? null,
                    "to_memo" => $detail['to_memo'] ?? null,
                ];
                $this->repo->storeMtgDetail($model);
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
