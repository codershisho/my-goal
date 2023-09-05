<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ITopicRepository
{
    /**
     * m_topicsの全件検索
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * m_topic_detailsの全件検索
     *
     * @return Collection
     */
    public function allDetails(): Collection;
}
