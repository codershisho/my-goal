<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\IGoalRepository;
use App\Models\TGoal;

class GoalRepository implements IGoalRepository
{
    public function index($termId)
    {
        $today = now();
        $goals = TGoal::all();
        logger($today);
        return $goals;
    }

    public function update($request, $termId)
    {
        $goal = TGoal::find($termId);
        $goal->fill($request->all())->save();
    }
}