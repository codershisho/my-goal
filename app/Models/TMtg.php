<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TMtg extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d',
    ];

    public function fromUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'from_user_id');
    }

    public function toUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'to_user_id');
    }
}
