<?php

namespace App\Services\Mtg;

use App\Interfaces\IMtgRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreService
{
    private $repo;

    public function __construct(IMtgRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * ミーティング情報を登録
     *
     * @param array $request
     * @return void
     */
    public function execStore(array $request)
    {
        try {
            DB::beginTransaction();

            $model = [
                "mtg_date" => $request['mtg_date'],
                "status" => $request['status'],
                "from_user_id" => Auth::id(),
                "to_user_id" => $request['to_user_id'],
            ];

            // t_mtgsの登録
            $createdMeeting = $this->repo->createMeetingBase($model);
            $mtgId = $createdMeeting->id;

            // t_mtg_detailの登録
            $topics = collect($request['topics']);
            $createdDetails = $topics->each(function ($topic) use ($mtgId) {
                $model = [
                    "mtg_id" => $mtgId,
                    "topic_id" => $topic['topic_id'],
                    "topic_checked" => $topic['checked'] ?? 0,
                    "topic_detail_id" => $topic['selected'] ?? 6,
                    "from_memo" => encrypt($topic['from_memo'] ?? null),
                    "to_memo" => encrypt($topic['to_memo'] ?? null),
                ];
                return $this->repo->createMeetingDetail($model);
            });

            DB::commit();

            return compact('createdMeeting', 'createdDetails');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
