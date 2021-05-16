<?php

namespace App\Entities;

use Illuminate\Support\Facades\Redis;

trait Learning {
   /**
     * Gets a lessons
     * 
     * Marks it as completed by storing in the Redis set for completed lessons
     */

    public function completeLesson($lesson)
    {
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    /**
     * Gets a series
     * 
     * returns total completed lesson count
     */

    public function getNumberOfCompletedLessonInSeries($series)
    {
        return count(Redis::smembers("user:{$this->id}:series:{$series->id}"));
    }

    /**
     * Gets a series as attribute
     * 
     * returns percentage of completed lessons from the series
     */

    public function getPercentageCompletedForSeries($series)
    {
        $total_lessons = $series->lessons->count();
        $completed_lessons = $this->getNumberOfCompletedLessonInSeries($series);
        
        return ($completed_lessons/$total_lessons) * 100;
    }

    /**
     * Checks if the user has started a series or not
     * 
     * if user has completed atlest one lesson from series then return true
     */
    public function hasStartedSeries($series)
    {
       return $this->getNumberOfCompletedLessonInSeries($series) > 0;
    }
}