<?php

namespace App\Repositories;

use App\Interfaces\ITopicRepository;
use App\Models\MTopic;
use App\Models\MTopicDetail;
use Illuminate\Database\Eloquent\Collection;

class TopicRepository implements ITopicRepository
{
    public function all(): Collection
    {
        return MTopic::all();
    }

    public function allDetails(): Collection
    {
        return MTopicDetail::all();
    }
}
