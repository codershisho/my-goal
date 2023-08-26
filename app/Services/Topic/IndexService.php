<?php

namespace App\Services\Topic;

use App\Http\Resources\TopicsResource;
use App\Interfaces\ITopicRepository;

/**
 * Topicの一覧検索
 */
class IndexService
{
    private $repo;

    public function __construct(ITopicRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * m_topicsの全件検索
     *
     * @return void
     */
    public function execIndex()
    {
        $data = $this->repo->all();
        return TopicsResource::collection($data);
    }
}
