<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * m_topicのリソースクラス
 * - relation含む
 */
class TopicsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "topic_id" => $this->id,
            "topic_name" => $this->name,
            "details" => TopicDetailsResource::collection($this->details)
        ];
    }
}
