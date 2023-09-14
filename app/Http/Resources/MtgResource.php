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
            "status" => $status,
            "to_user_name" => $this->toUser->name,
            "created_at" => $this->created_at->format('Y-m-d'),
            "updated_at" => $this->updated_at->format('Y-m-d'),
        ];
    }
}
