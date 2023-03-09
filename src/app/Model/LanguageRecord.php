<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LanguageRecord extends Model
{
    //
    protected $fillable = [
        'date',
        'study_hour',
        'user_id',
        'learning_language_id',
    ];
    // public function learning_languages()
    // {
    //     return $this->hasMany('App\Model\LearningLanguage');
    // }
}
