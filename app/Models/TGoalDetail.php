<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TGoalDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    public function topicDetail()
    {
        return $this->belongsTo('App\Models\MTopicDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
