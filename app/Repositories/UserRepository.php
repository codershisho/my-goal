<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements IUserRepository
{
    public function all(): Collection
    {
        return User::all();
    }
}
