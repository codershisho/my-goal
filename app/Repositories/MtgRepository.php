<?php

namespace App\Repositories;

use App\Const\MessageConst;
use App\Interfaces\IMtgRepository;
use App\Models\TMtg;
use App\Models\TMtgDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class MtgRepository implements IMtgRepository
{
    public function findMettingsByLoginUser(): Collection
    {
        $data = TMtg::with(['fromUser', 'toUser'])->get();
        return $data->where('from_user_id', Auth::id());
    }

    public function findMeetingBaseById($meetingId): TMtg
    {
        return TMtg::find($meetingId);
    }

    public function findMeetingDetailsByMeetingId($meetingId): Collection
    {
        return TMtgDetail::with(['topic'])->where('mtg_id', $meetingId)->get();
    }

    public function createMeetingBase($model): TMtg
    {
        $m = new TMtg();
        $m->fill($model);
        $m->save();

        return $m;
    }

    public function createMeetingDetail($model): void
    {
        $m = new TMtgDetail();
        $m->fill($model);
        $m->save();
    }

    public function updateMeetingBase($model): void
    {
        $m = $this->findMeetingBaseById($model['id']);

        if (!isset($m)) {
            throw new Exception(MessageConst::MESSAGE_100);
        }

        $m->fill($model);
        $m->save();
    }

    public function updateMtgDetail($model): void
    {
        $m = TMtgDetail::find($model['id']);

        if (!isset($m)) {
            throw new Exception(MessageConst::MESSAGE_100);
        }

        $m->fill($model);
        $m->save();
    }
}
