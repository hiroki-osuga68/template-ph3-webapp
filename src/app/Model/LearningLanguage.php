<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LearningLanguage extends Model
{
    //
    protected $fillable = [
        'name',
        'color',
    ];
    public function language_records()
    {
        return $this->hasMany('App\Model\LanguageRecord');
    }
}
