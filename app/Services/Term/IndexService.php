<?php

namespace App\Services\Term;

use App\Http\Resources\TermResource;
use App\Interfaces\ITermRepository;

class IndexService
{
    private $repo;

    public function __construct(ITermRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 期の一覧を検索して返す
     *
     * @return TermResource[]
     */
    public function execIndex()
    {
        $data = $this->repo->all();
        return TermResource::collection($data);
    }
}
