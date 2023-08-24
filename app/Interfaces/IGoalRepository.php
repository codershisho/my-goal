<?php

namespace App\Interfaces;

use App\Models\TGoal;
use Illuminate\Database\Eloquent\Collection;

interface IGoalRepository
{
    /**
     * t_goalsの期に紐づく全件検索
     *
     * @param int $termId
     * @return Collection
     */
    public function index(int $termId): Collection;

    /**
     * t_goalsのid検索
     * - termIdとuserIdで一意になる
     *
     * @param integer $termId
     * @param integer $userId
     * @return TGoal
     */
    public function find(int $termId): TGoal;

    /**
     * t_goalsの1件更新
     *
     * @param int $termId
     * @param object $request
     * @return void
     */
    public function update(int $termId, $request): void;
}
