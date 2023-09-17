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

    /**
     * 指定されたt_mtgsの情報を返す
     *
     * @param [type] $id
     * @return MtgResource
     */
    public function execBase($id)
    {
        $data = $this->repo->findMeetingBaseById($id);
        return new MtgResource($data);
    }
}
