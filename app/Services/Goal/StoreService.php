<?php

namespace App\Services\Goal;

use App\Interfaces\IGoalRepository;
use Illuminate\Support\Facades\DB;

class StoreService
{

    private $repo;

    public function __construct(IGoalRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * t_goalsの新規登録
     *
     * @param integer $termId
     * @param array $request
     * @return void
     */
    public function execCreate(int $termId, array $request)
    {
        try {
            DB::beginTransaction();

            $this->repo->create($termId, $request);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
