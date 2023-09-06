<?php

namespace App\Services\Mtg;

use App\Http\Resources\MtgDetailResource;
use App\Interfaces\IMtgRepository;

class ShowSerivice
{
    private $repo;

    public function __construct(IMtgRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execShow($id)
    {
        $data = $this->repo->find($id);
        return MtgDetailResource::collection($data);
    }
}
