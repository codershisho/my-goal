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

    public function execIndex()
    {
        $data = $this->repo->all();
        return $data;
    }
}
