<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TMtgDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function topic()
    {
        return $this->hasOne('App\Models\MTopic', 'id', 'topic_id');
    }

    public function topicDetail()
    {
        return $this->hasOne('App\Models\MTopicDetail', 'id', 'topic_detail_id');
    }
}
