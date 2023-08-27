<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ITopicRepository
{
    /**
     * m_topicsの全件検索
     * - relation含む
     *
     * @return Collection
     */
    public function all(): Collection;
}
