<?php

namespace App\Services\Goal;

use App\Interfaces\IGoalRepository;

class ShowService
{
    private $repo;

    public function __construct(IGoalRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     *期とログインユーザーに紐づく目標を返す
     *
     * @param [type] $termId
     * @return void
     */
    public function execShow($termId)
    {
        $data = $this->repo->findByLoginUser($termId);
        return $data;
    }
}
