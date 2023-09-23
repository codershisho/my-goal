<?php

namespace App\Interfaces;

use App\Models\TMtg;
use App\Models\TMtgDetail;
use Illuminate\Database\Eloquent\Collection;

interface IMtgRepository
{
    /**
     * ログイン者に紐づくMTG一覧を検索
     *
     * @return Collection
     */
    public function findMettingsByLoginUser(): Collection;

    /**
     * 管理者用に自部署のMTG一覧を検索
     *
     * @return Collection
     */
    public function findMeetingsByAdmin(): Collection;

    /**
     * t_mtgsのid検索
     *
     * @param int $meetingId
     * @return TMtg
     */
    public function findMeetingBaseById($meetingId): TMtg;

    /**
     * t_mtg_detailsのid検索
     *
     * @param int $meetingId
     * @return Collection
     */
    public function findMeetingDetailsByMeetingId($meetingId): Collection;

    /**
     * t_mtgsへ新規登録
     *
     * @param array{
     *   mtg_date: string,
     *   status: int,
     *   from_user_id: int,
     *   to_user_id: int
     * } $model
     *
     * @return TMtg
     */
    public function createMeetingBase($model): TMtg;

    /**
     * t_mtg_detalsへ新規登録
     *
     * @param array{
     *   mtg_id:int,
     *   topic_id:int,
     *   topic_checked:int,
     *   topic_detail_id:int,
     *   from_memo:string,
     *   to_memo:string,
     * } $model
     * @return void
     */
    public function createMeetingDetail($model): void;

    /**
     * t_mtgsの更新
     *
     * @param array{
     *   id: int,
     *   mtg_date: string,
     *   status: int,
     *   from_user_id: int,
     *   to_user_id: int
     * } $model
     * @return void
     */
    public function updateMeetingBase($model): void;

    /**
     * t_mtg_detalsの更新
     *
     * @param array{
     *   id: int,
     *   topic_id:int,
     *   topic_checked:int,
     *   topic_detail_id:int,
     *   from_memo:string,
     *   to_memo:string,
     * } $model
     * @return void
     */
    public function updateMtgDetail($model): void;
}
