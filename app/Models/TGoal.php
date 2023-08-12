<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TGoal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    public function term()
    {
        return $this->belongsTo('App\Models\MTerm');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
