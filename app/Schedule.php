<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function job()
    {
        return $this->belongsTo(\App\Job::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function formattedWhen()
    {
        $date = Carbon::parse($this->when)->locale('ru');
        $date->settings(['formatFunction' => 'translatedFormat']);

        return $date->format('\\<\\s\\t\\r\\o\\n\\g\\>H:i\\<\\/\\s\\t\\r\\o\\n\\g\\> d.m.Y \\(l\\)');
    }
}
