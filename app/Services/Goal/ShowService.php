<?php

namespace App\Services\Goal;

use App\Http\Resources\GoalResource;
use App\Interfaces\IGoalRepository;
use Illuminate\Support\Facades\Auth;

class ShowService
{
    private $repo;

    public function __construct(IGoalRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     *期とログインユーザーに紐づく目標を返す
     *
     * @param [type] $termId
     * @return void
     */
    public function execShow($termId)
    {
        $data = $this->repo->findByLoginUser($termId);
        if (empty($data)) {
            $data = (object)[
                'id' => 0,
                'term_id' => $termId,
                'user_id' => Auth::id(),
                'goal_department' => '',
                'goal_first' => '',
                'goal_secound' => ''
            ];
        }
        return new GoalResource($data);
    }
}
