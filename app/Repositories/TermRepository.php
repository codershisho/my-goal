<?php

namespace App\Repositories;

use App\Interfaces\ITermRepository;
use App\Models\MTerm;
use Illuminate\Database\Eloquent\Collection;

class TermRepository implements ITermRepository
{
    public function index(): Collection
    {
        return MTerm::all();
    }
}
