<?php

namespace App\Repositories;

use App\Interfaces\IMtgRepository;
use App\Models\TMtg;
use App\Models\TMtgDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MtgRepository implements IMtgRepository
{
    public function storeMtg($model): TMtg
    {
        try {
            DB::beginTransaction();

            $m = new TMtg();
            $m->fill($model);
            $m->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return $m;
    }

    public function storeMtgDetail(int $mtgId, $model): void
    {
        try {
            DB::beginTransaction();

            // ラジオボタンが未選択のデータは登録しない
            if (!isset($model['topic_detail_id'])) {
                return;
            }
            $m = new TMtgDetail();
            $m->fill($model);
            $m->mtg_id = $mtgId;
            $m->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
