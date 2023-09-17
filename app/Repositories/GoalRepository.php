<?php

namespace App\Repositories;

use App\Const\MessageConst;
use App\Interfaces\IGoalRepository;
use App\Models\TGoal;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class GoalRepository implements IGoalRepository
{
    public function index(int $termId): Collection
    {
        $goals = TGoal::where('term_id', $termId)->get();
        return $goals;
    }

    public function findByLoginUser(int $termId): ?TGoal
    {
        return TGoal::where('term_id', $termId)->where('user_id', Auth::id())->first();
    }

    public function create(int $termId, array $model): void
    {
        $m = new TGoal();
        $m->fill($model);
        $m->user_id = Auth::id();
        $m->save();
    }

    public function update(int $termId, array $model): void
    {
        $m = $this->findByLoginUser($termId);

        if (empty($m)) {
            throw new Exception(MessageConst::MESSAGE_100);
        }

        $m->fill($model);
        $m->user_id = Auth::id();
        $m->save();
    }
}
