<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * t_mtg_detailsのリソースクラス
 */
class MtgDetailResource extends JsonResource
{
    private static $details;

    public function toArray($request)
    {
        return [
            "topic_id" => $this->topic_id,
            "topic_name" => $this->topic->name,
            "details" => self::$details,
            "mtg_detail_id" => $this->id,
            "checked" => $this->topic_checked == 1 ? true : false,
            "selected" => $this->topic_detail_id,
            "from_memo" => decrypt($this->from_memo ?? ''),
            "to_memo" => decrypt($this->to_memo ?? '')
        ];
    }

    public static function setTopicDetails($details)
    {
        self::$details = $details;
    }
}
