<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LearningContent extends Model
{
    //
    public function content_records()
    {
        return $this->hasMany('App\Model\ContentRecord');
    }
}
