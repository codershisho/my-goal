<?php

namespace App\Services\Mtg;

use App\Http\Resources\MtgDetailResource;
use App\Http\Resources\MtgResource;
use App\Interfaces\IMtgRepository;
use App\Interfaces\ITopicRepository;

class DetailService
{
    private $repo;
    private $trepo;

    public function __construct(IMtgRepository $repo, ITopicRepository $trepo)
    {
        $this->repo = $repo;
        $this->trepo = $trepo;
    }

    /**
     * ミーティングIDに紐づくミーティング詳細を返す
     * - トピック情報も付加して返す
     *
     * @param int $meetingId
     * @return MtgDetailResource[]
     */
    public function execDetail($meetingId)
    {
        $meetingDetails = $this->repo->findMeetingDetailsByMeetingId($meetingId);
        $topicDetails = $this->trepo->allDetails();

        MtgDetailResource::setTopicDetails($topicDetails);
        return MtgDetailResource::collection($meetingDetails);
    }
}
