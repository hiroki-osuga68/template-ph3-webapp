<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
// 論理削除モデル追加
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningLanguage extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name',
        'color',
    ];
    public function language_records()
    {
        return $this->hasMany('App\Model\LanguageRecord');
    }
}
