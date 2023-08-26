<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * m_topic_detailsのリソースクラス
 */
class TopicDetailsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "topic_detail_id" => $this->id,
            "topic_detail_name" => $this->name,
        ];
    }
}
