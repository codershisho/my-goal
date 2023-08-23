<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TGoal;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\Interfaces\IGoalRepository;

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
        $goals = TGoal::all();
        logger($today);
        return $goals;
    }

    public function update(Request $request, $termId)
    {
        DB::beginTransaction();
        try {
            logger('BBBBB');
            $this->repo->update($request, $termId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        // return $goals;
    }
}
