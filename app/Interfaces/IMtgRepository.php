<?php

namespace App\Interfaces;

use App\Models\TMtg;
use App\Models\TMtgDetail;
use Illuminate\Database\Eloquent\Collection;

interface IMtgRepository
{
    /**
     * MTGの登録
     *
     * @param [type] $model
     * @return TMtg
     */
    public function storeMtg($model): TMtg;

    /**
     * MTG詳細の登録
     *
     * @param int $mtgId
     * @param [type] $model
     * @return void
     */
    public function storeMtgDetail($model): void;

    /**
     * 作成しようとしているMTGに重複するデータがないかチェック
     *
     * @return boolean
     */
    public function duplicateMtg($model): bool;

    /**
     * ログイン者に紐づくMTG一覧を検索
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * t_mtgの単純なfind
     *
     * @param [type] $id
     * @return TMtg
     */
    public function findOfMtg($id): TMtg;

    /**
     * t_mtg_detailsのid検索
     *
     * @param [type] $id
     * @return Collection
     */
    public function findMeetingDetails($id): Collection;

    /**
     * MTGの更新
     *
     * @param [type] $model
     * @return void
     */
    public function updateMtg($model);

    /**
     * MTG詳細の更新
     *
     * @param [type] $model
     * @return void
     */
    public function updateMtgDetail($model);
}
