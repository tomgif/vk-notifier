<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'message', 'when', 'user_id', 'attachments'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(\App\Job::class, 'job_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * @return string
     */
    public function formattedWhen()
    {
        $date = Carbon::parse($this->when)->locale('ru');
        $date->settings(['formatFunction' => 'translatedFormat']);

        return $date->format('\\<\\s\\t\\r\\o\\n\\g\\>H:i\\<\\/\\s\\t\\r\\o\\n\\g\\> d.m.Y \\(l\\)');
    }

    /**
     * @param Builder $query
     * @param bool $value
     * @return Builder
     */
    public function scopeIsCompleted(Builder $query, bool $value)
    {
        return $query->where('completed', $value);
    }
}
