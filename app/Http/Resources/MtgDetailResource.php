<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * t_mtg_detailsのリソースクラス
 */
class MtgDetailResource extends JsonResource
{
    public function toArray($request)
    {

        $children = collect($this->children);

        $topics = $children->map(function ($child) {
            return [
                "mtg_detail_id" => $child["id"],
                "topic_id" => $child["topic_id"],
                "checked" => $child["topic_checked"] == 1 ? true : false,
                "selected" => $child["topic_detail_id"],
            ];
        });

        return [
            "mtg_id" => $this->id,
            "mtg_date" => $this->mtg_date,
            "to_user_id" => $this->to_user_id,
            "topics" => $topics
        ];
    }
}
