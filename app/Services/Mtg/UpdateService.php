<?php

namespace App\Services\Mtg;

use App\Interfaces\IMtgRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UpdateService
{
    private $repo;

    public function __construct(IMtgRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * ミーティング情報を更新
     *
     * @param array $params
     * @return void
     */
    public function execUpdate(array $params)
    {
        try {
            DB::beginTransaction();

            $model = [
                'id' => $params['mtg_id'],
                'mtg_date' => $params['mtg_date'],
                'status' => $params['status'],
                "from_user_id" => Auth::id(),
                'to_user_id' => $params['to_user_id'],
            ];

            $this->repo->updateMeetingBase($model);

            // t_mtg_detailの登録
            collect($params['topics'])->each(function ($topic) {
                $model = [
                    "id" => $topic['mtg_detail_id'],
                    "topic_id" => $topic['topic_id'],
                    "topic_checked" => $topic['checked'],
                    "topic_detail_id" => $topic['selected'] == 0 ? 6 : $topic['selected'],
                    "from_memo" => encrypt($topic['from_memo'] ?? null),
                    "to_memo" => encrypt($topic['to_memo'] ?? null),
                ];
                $this->repo->updateMtgDetail($model);
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
