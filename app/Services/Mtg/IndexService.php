<?php

namespace App\Services\Mtg;

use App\Http\Resources\MtgResource;
use App\Interfaces\IMtgRepository;

class IndexService
{
    private $repo;

    public function __construct(IMtgRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execIndex()
    {
        $data = $this->repo->all();
        return MtgResource::collection($data);
    }
}
