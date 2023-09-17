<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'term_id' => $this->term_id,
            'user_id' => $this->user_id,
            'goal_department' => $this->goal_department,
            'goal_first' => $this->goal_first,
            'goal_secound' => $this->goal_secound
        ];
    }
}
