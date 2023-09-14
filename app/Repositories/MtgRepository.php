<?php

namespace App\Repositories;

use App\Interfaces\IMtgRepository;
use App\Models\TMtg;
use App\Models\TMtgDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class MtgRepository implements IMtgRepository
{
    public function storeMtg($model): TMtg
    {
        $m = new TMtg();
        $m->fill($model);
        $m->save();

        return $m;
    }

    public function storeMtgDetail($model): void
    {
        $m = new TMtgDetail();
        $m->fill($model);
        $m->save();
    }

    public function duplicateMtg($model): bool
    {
        $data = TMtg::where('mtg_date', $model['mtg_date'])
            ->where('from_user_id', $model['from_user_id'])
            ->where('to_user_id', $model['to_user_id'])
            ->count();

        if ($data > 0) {
            return true;
        }
        return false;
    }

    public function all(): Collection
    {
        $data = TMtg::with(['fromUser', 'toUser'])->get();

        return $data->where('from_user_id', Auth::id());
    }

    public function findOfMtg($id): TMtg
    {
        return TMtg::find($id);
    }

    public function findMeetingDetails($id): Collection
    {
        return TMtgDetail::with(['topic'])->where('mtg_id', $id)->get();
    }

    public function findOfMtgDetail($id): TMtgDetail
    {
        return TMtgDetail::find($id);
    }

    public function updateMtg($model)
    {
        $m = $this->findOfMtg($model['id']);

        if (!isset($m)) {
            throw new Exception("更新対象が存在しません");
        }

        $m->fill($model);
        $m->save();
    }

    public function updateMtgDetail($model)
    {
        $m = $this->findOfMtgDetail($model['id']);

        if (!isset($m)) {
            throw new Exception("更新対象が存在しません");
        }

        $m->fill($model);
        $m->save();
    }
}
