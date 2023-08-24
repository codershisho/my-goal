<?php

namespace App\Services\Goal;

use App\Interfaces\IGoalRepository;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return void
     */
    public function execUpdate(int $termId, Request $request)
    {
        $this->repo->update($termId, $request);
    }
}
