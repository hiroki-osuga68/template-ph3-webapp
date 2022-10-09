<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LearningLanguage extends Model
{
    //
    public function language_records()
    {
        return $this->hasMany('App\Model\LanguageRecord');
    }
}
