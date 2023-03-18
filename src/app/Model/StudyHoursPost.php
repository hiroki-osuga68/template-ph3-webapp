<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudyHoursPost extends Model
{
    protected $fillable = [
        'user_id',
        'total_hour',
        'study_date',
    ];
}
