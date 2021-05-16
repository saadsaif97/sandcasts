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
        return $this->series->lessons()->where('episode_number', '>', $this->episode_number)->orderBy('episode_number', 'asc')->first();
    }

    public function previousLesson()
    {
        return $this->series->lessons()->where('episode_number', '<', $this->episode_number)->orderBy('episode_number', 'desc')->first();
    }
}
