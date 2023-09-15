<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ITermRepository
{
    /**
     * m_termsの全件検索
     *
     * @return Collection
     */
    public function index(): Collection;
}
