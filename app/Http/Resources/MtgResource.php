<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * t_mtgsのリソースクラス
 */
class MtgResource extends JsonResource
{
    public function toArray($request)
    {
        $status = $this->status == 0 ? '未実施' : '実施済み';

        return [
            "mtg_id" => $this->id,
            "mtg_date" => $this->mtg_date,
            "status" => $this->status,
            "status_name" => $status,
            "from_user_id" => $this->from_user_id,
            "from_user_name" => $this->fromUser->name,
            "from_user_avatar" => $this->fromUser->avatar ?? '',
            "to_user_id" => $this->to_user_id,
            "to_user_name" => $this->toUser->name,
            "to_user_avatar" => $this->toUser->avatar ?? '',
            "created_at" => $this->created_at->format('Y-m-d'),
            "updated_at" => $this->updated_at->format('Y-m-d'),
        ];
    }
}
