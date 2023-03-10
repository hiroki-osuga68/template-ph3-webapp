<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LearningContent extends Model
{
    //
    protected $fillable = [
        'name',
        'color',
    ];
    public function content_records()
    {
        return $this->hasMany('App\Model\ContentRecord');
    }
}
