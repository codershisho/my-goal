<?php

namespace App\Services\User;

use App\Interfaces\IUserRepository;

class IndexService
{

    private $repo;

    public function __construct(IUserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * ユーザー一覧を返す
     *
     * @return void
     */
    public function execIndex()
    {
        $data = $this->repo->all();
        return $data;
    }
}
