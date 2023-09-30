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
        $data = TMtg::with(['fromUser', 'toUser'])->orderBy('mtg_date', 'desc')->orderBy('id', 'desc')->get();
        $data = $data->filter(function ($tmg) {
            return $tmg->from_user_id == Auth::id() || $tmg->to_user_id == Auth::id();
        });
        return $data;
    }

    public function findMeetingsByAdmin(): Collection
    {
        // ログイン者の部署IDを取得
        $user = Auth::user();
        $data = TMtg::with(['fromUser', 'toUser'])->orderBy('mtg_date', 'desc')->orderBy('id', 'desc')->get();
        // 自部署内でフィルタリング
        $data = $data->filter(function ($tmg) use ($user) {
            return $tmg->fromUser->department == $user['department'] && $tmg->toUser->department == $user['department'];
        });
        return $data;
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

    public function createMeetingDetail($model): TMtgDetail
    {
        $m = new TMtgDetail();
        $m->fill($model);
        $m->save();

        return $m;
    }

    public function updateMeetingBase($model): TMtg
    {
        $m = $this->findMeetingBaseById($model['id']);

        if (!isset($m)) {
            throw new Exception(MessageConst::MESSAGE_100);
        }

        $m->fill($model);
        $m->save();

        return $m;
    }

    public function updateMtgDetail($model): TMtgDetail
    {
        $m = TMtgDetail::find($model['id']);

        if (!isset($m)) {
            throw new Exception(MessageConst::MESSAGE_100);
        }

        $m->fill($model);
        $m->save();

        return $m;
    }
}
