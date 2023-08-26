<?php

namespace App\Repositories;

use App\Interfaces\ITopicRepository;
use App\Models\MTopic;
use Illuminate\Database\Eloquent\Collection;

class TopicRepository implements ITopicRepository
{
    public function all(): Collection
    {
        return MTopic::with('details')->get();
    }
}
