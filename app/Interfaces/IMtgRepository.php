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
    public function storeMtgDetail(int $mtgId, $model): void;
}
