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

    /**
     * ログイン者に紐づくミーティング一覧を返す
     *
     * @return MtgResource[]
     */
    public function execIndex()
    {
        $data = $this->repo->findMettingsByLoginUser();
        return MtgResource::collection($data);
    }
}
