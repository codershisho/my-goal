<?php

namespace App\Interfaces;

use App\Models\TMtg;
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
     * MTGの詳細検索
     *
     * @param [type] $id
     * @return void
     */
    public function find($id);
}
