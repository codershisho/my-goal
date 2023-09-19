<?php

namespace App\Services\Goal;

use App\Interfaces\IGoalRepository;
use Illuminate\Support\Facades\DB;

class UpdateService
{

    private $repo;

    public function __construct(IGoalRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * t_goalsの1件更新
     *
     * @param integer $termId
     * @param array $request
     * @return void
     */
    public function execUpdate(int $termId, array $request)
    {
        try {
            DB::beginTransaction();

            $this->repo->update($termId, $request);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
