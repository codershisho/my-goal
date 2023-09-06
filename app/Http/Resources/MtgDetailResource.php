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
        return [
            "mtg_id" => $this->mtg_id,
            "mtg_detail_id" => $this->id,
            "topic_id" => $this->topic_id,
            "topic_name" => $this->topic->name,
            "topic_detail_id" => $this->topicDetail->id,
            "topic_detail_name" => $this->topicDetail->name,
            "from_memo" => $this->from_memo,
            "to_memo" => $this->to_memo,
            "created_at" => $this->created_at->format('Y-m-d'),
            "updated_at" => $this->updated_at->format('Y-m-d'),
        ];
    }
}
