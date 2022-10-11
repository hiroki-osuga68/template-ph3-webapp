<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContentRecord extends Model
{
    //
    protected $fillable = [
        'date',
        'study_hour',
        'user_id',
        'learning_content_id',
    ];
    // public function learning_contents()
    // {
    //     return $this->hasMany('App\Model\LearningContent');
    // }
}
