<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository implements IUserRepository
{
    public function all(): Collection
    {
        return User::where('department', Auth::user()->department)->get();
    }
}
