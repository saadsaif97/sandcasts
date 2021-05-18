<?php

namespace Tests\Unit;

use App\Models\Lesson;
use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_get_completed_lessons()
    {
        $this->flushRedis();
        $user = User::factory()->create();
        
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([ 'series_id' => 1 ]);
        $lesson3 = Lesson::factory()->create([ 'series_id' => 1 ]);
        $lesson4 = Lesson::factory()->create([ 'series_id' => 1 ]);
        
        $user->completeLesson($lesson1);
        $user->completeLesson($lesson3);
        
        $this->assertEquals($user->getCompletedLessonsInSeries($lesson1->series), [1,3]);
    }

    public function test_a_user_has_completed_a_lesson()
    {
        $this->flushRedis();
        $user = User::factory()->create();
        
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([ 'series_id' => 1 ]);
        
        $user->completeLesson($lesson1);

        $this->assertTrue($user->hasCompletedLesson($lesson1));
        $this->assertFalse($user->hasCompletedLesson($lesson2));

    }

    public function test_a_user_can_complete_a_lesson()
    {
        $this->flushRedis();

        $user = User::factory()->create();

        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([
            'series_id' => '1'
        ]);
        
        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $this->assertEquals(Redis::smembers("user:1:series:1"), [1,2]);
    }


    public function test_a_user_can_get_percentage_completed_for_series()
    {
        $this->flushRedis();

        $user = User::factory()->create();

        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([
            'series_id' => '1'
        ]);
        Lesson::factory()->create([ 'series_id' => '1' ]);
        Lesson::factory()->create([ 'series_id' => '1' ]);
        
        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $this->assertEquals($user->getNumberOfCompletedLessonInSeries($lesson1->series), 2);

        $this->assertEquals($user->getPercentageCompletedForSeries($lesson1->series), 50);
    }

    public function test_can_know_user_has_started_series()
    {
        $this->flushRedis();

        $user = User::factory()->create();

        // lessons belong to series 1
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([
            'series_id' => '1'
        ]); 

        // lesson belongs to series 2
        $lesson3 = Lesson::factory()->create();

        $user->completeLesson($lesson1);
        
        $this->assertTrue($user->hasStartedSeries($lesson1->series));
        $this->assertFalse($user->hasStartedSeries($lesson3->series));
    }

    public function test_a_user_can_get_series_being_watched()
    {
        $this->flushRedis();

        $user = User::factory()->create();
        $this->actingAs($user);

        // lessons belong to series 1
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([ 'series_id' => '1' ]); 
        // lessons belong to series 2
        $lesson3 = Lesson::factory()->create();
        $lesson4 = Lesson::factory()->create([ 'series_id' => '2' ]); 
        // lessons belong to series 3
        $lesson5 = Lesson::factory()->create();
        $lesson6 = Lesson::factory()->create([ 'series_id' => '3' ]); 

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson3);

        $startedSeries = $user->getStartedSeries();

        $this->assertInstanceOf(Series::class, $startedSeries->random());

        $idsOfStartedSeries = $startedSeries->pluck('id')->toArray();

        $this->assertTrue(in_array(1, $idsOfStartedSeries));
        $this->assertTrue(in_array(2, $idsOfStartedSeries));
        $this->assertFalse(in_array(3, $idsOfStartedSeries));
    }

    public function test_a_user_can_get_total_number_of_completed_lessons()
    {

        $this->flushRedis();

        $user = User::factory()->create();
        $this->actingAs($user);

        // lessons belong to series 1
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([ 'series_id' => '1' ]); 
        // lessons belong to series 2
        $lesson3 = Lesson::factory()->create();
        $lesson4 = Lesson::factory()->create([ 'series_id' => '2' ]); 
        // lessons belong to series 3
        $lesson5 = Lesson::factory()->create();
        $lesson6 = Lesson::factory()->create([ 'series_id' => '3' ]); 

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);
        $user->completeLesson($lesson5);

        $this->assertEquals($user->getTotalNumberOfCompletedLessons(), 3);
    }

    public function test_a_user_can_get_next_lesson_to_watch_from_series()
    {
        $this->flushRedis();

        $user = User::factory()->create();
        $this->actingAs($user);

        // lessons belong to series 1
        $lesson1 = Lesson::factory()->create([ 'episode_number' => 1 ]);
        $lesson2 = Lesson::factory()->create([ 'series_id' => '1', 'episode_number' => 2 ]);
        $lesson3 = Lesson::factory()->create([ 'series_id' => '1', 'episode_number' => 3 ]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);
        

        $this->assertEquals($user->getNextLessonToWatch($lesson1->series)->id, $lesson3->id);
        $user->completeLesson($lesson3);
        $this->assertEquals($user->getNextLessonToWatch($lesson1->series)->id, $lesson3->id);
    }
}
