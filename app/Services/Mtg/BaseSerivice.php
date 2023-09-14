<?php

namespace App\Services\Mtg;

use App\Http\Resources\MtgResource;
use App\Interfaces\IMtgRepository;

class BaseSerivice
{
    private $repo;

    public function __construct(IMtgRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execBase($id)
    {
        $data = $this->repo->findOfMtg($id);
        return new MtgResource($data);
    }
}
