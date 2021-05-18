<?php

namespace App\Entities;

use App\Models\Lesson;
use App\Models\Series;
use Illuminate\Support\Facades\Redis;

trait Learning {
   /**
     * Marks it as completed by storing in the Redis set for completed lessons
     * 
     * @param App\Models\Lesson $lesson 
     * 
     * @return void
     */

    public function completeLesson($lesson)
    {
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);
    }

    /**
     * Gets completed lessons in series
     * 
     * @return Array of completed lessons ids
     */

     public function getCompletedLessonsInSeries($series)
     {
         return Redis::smembers("user:{$this->id}:series:{$series->id}");
     }

    /**
     * Checks if user has complted lesson
     * 
     * @param App\Models\Lesson $lesson
     * 
     * @return bool
     */

     public function hasCompletedLesson($lesson)
     {
         return in_array($lesson->id, $this->getCompletedLessonsInSeries($lesson->series));
     }

    /**
     * returns total completed lesson count
     * 
     * @param App\Models\Series $series
     * 
     * @return int
     */

    public function getNumberOfCompletedLessonInSeries($series)
    {
        return count(Redis::smembers("user:{$this->id}:series:{$series->id}"));
    }

    /**
     * Gets a series as attribute
     * 
     * returns percentage of completed lessons from the series
     * 
     * @return int
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
     * 
     * @param App\Models\Series $series
     * 
     * @return bool
     */
    public function hasStartedSeries($series)
    {
       return $this->getNumberOfCompletedLessonInSeries($series) > 0;
    }

    /**
     * Gets started series id
     * 
     * @return Array of keys each key is of format 'user:USER_ID:series:SERIES_ID'
     */
    public function getStartedSeriesIds()
    {
      return Redis::keys("user:{$this->id}:series:*");  
    }

    /**
     * Gets the started series as collections
     * 
     * @return Array[Series]
     */

     public function getStartedSeries()
     {
        $seriesIds = array_map(function($key){
            return explode(':', $key)[3];
        }, $this->getStartedSeriesIds());
        
        return collect($seriesIds)->map(function($id){
            return Series::find($id);
        })->filter();
     }

     /**
      * Gets total number of lesson from all series
      * 
      * @return Array[1,2,3] of ids
      */

      public function getTotalNumberOfCompletedLessons()
      {
        $keys = Redis::keys("user:{$this->id}:series:*");
        $total_lessons = 0;

        foreach($keys as $key):
            $total_lessons += count(Redis::smembers($key));
        endforeach;

        return  $total_lessons;
      }

      /**
       * Get next lesson to watch
       * 
       * @return Lesson
       */
      public function getNextLessonToWatch($series)
      {
        $last_complted_lesson_id = last($this->getCompletedLessonsInSeries($series));
        return Lesson::findOrFail($last_complted_lesson_id)->nextLesson();
      }
}