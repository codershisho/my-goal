<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TGoal;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\Interfaces\IGoalRepository;
use App\Http\Resources\GoalResource;
use App\Http\Requests\GoalRequest;

class GoalApi extends Controller
{
    private $repo;

    public function __construct(IGoalRepository $repository)
    {
        $this->repo = $repository;
    }
    public function index($termId)
    {
        $today = now();
        $goal = TGoal::with('term', 'user')->find($termId);
        $termFrom = $goal->term->from;
        $termTo = $goal->term->to;
        if($today >= $termFrom && $today <= $termTo){
            return new GoalResource($goal);
        }
        return 'noData';
    }

    public function update(GoalRequest $request, $termId)
    {
        DB::beginTransaction();
        try {
            logger($request);
            $this->repo->update($request, $termId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
