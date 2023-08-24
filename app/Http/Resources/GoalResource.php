<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'goal_id' => $this->id,
            'term_id' => $this->term_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'goal_department' => $this->goal_department,
            'goal_first' => $this->goal_first,
            'goal_secound' => $this->goal_secound,
        ];
    }
}