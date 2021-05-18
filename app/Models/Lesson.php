<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function nextLesson()
    {
        $next_lesson = $this->series->lessons()->where('episode_number', '>', $this->episode_number)->orderBy('episode_number', 'asc')->first();

        if ($next_lesson) {
            return $next_lesson;
        }

        return $this;
    }

    public function previousLesson()
    {
        $previous_lesson = $this->series->lessons()->where('episode_number', '<', $this->episode_number)->orderBy('episode_number', 'desc')->first();

        if ($previous_lesson) {
            return $previous_lesson;
        }

        return $this;
    }
}
