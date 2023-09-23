<?php

namespace App\Services\Goal;

use App\Interfaces\IGoalRepository;

class IndexService
{

    private $repo;

    public function __construct(IGoalRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * t_goalsの検索処理
     *
     * @param int $termId
     * @return void
     */
    public function execIndex(int $termId)
    {
        $data = $this->repo->find($termId);
        return $data;
    }
}
