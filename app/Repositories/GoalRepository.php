<?php

namespace App\Repositories;

use App\Interfaces\IGoalRepository;
use App\Models\TGoal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GoalRepository implements IGoalRepository
{
    // TODO termidとuseridで一意になるので、これ、いらんね。。。
    public function index(int $termId): Collection
    {
        $goals = TGoal::where('term_id', $termId)->get();
        return $goals;
    }

    public function find(int $termId): TGoal
    {
        // TODO userIdの絞り込みもプラス
        // loginを通しているからAuth::user()で取れるはず。。。
        return TGoal::where($termId)->get();
    }

    public function update($termId, $request): void
    {
        try {
            DB::beginTransaction();

            $goal = $this->find($termId);
            // TODO userIdは更新させないほうがいいかも念のため
            $goal->fill($request->all())->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
