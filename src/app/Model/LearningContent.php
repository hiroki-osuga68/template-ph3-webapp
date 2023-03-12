<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
// 論理削除モデル追加
use Illuminate\Database\Eloquent\SoftDeletes;


class LearningContent extends Model
{
    //
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'color',
    ];
    public function content_records()
    {
        return $this->hasMany('App\Model\ContentRecord');
    }
}
