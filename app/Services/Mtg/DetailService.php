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

    public function execDetail($id)
    {
        $meetingDetails = $this->repo->findMeetingDetails($id);
        $topicDetails = $this->trepo->allDetails();

        MtgDetailResource::setTopicDetails($topicDetails);
        return MtgDetailResource::collection($meetingDetails);
    }
}
