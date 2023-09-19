<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    /**
     * usersの全件検索
     *
     * @return Collection<User>
     */
    public function all(): Collection;
}
