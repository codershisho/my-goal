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
     * @return TGoal|null
     */
    public function findByLoginUser(int $termId): ?TGoal;

    /**
     * t_goalの新規登録
     *
     * @param integer $termId
     * @param array $model
     * @return void
     */
    public function create(int $termId, array $model): void;

    /**
     * t_goalsの1件更新
     *
     * @param int $termId
     * @param array $model
     * @return void
     */
    public function update(int $termId, array $model): void;
}
