<?php

namespace Tests\Unit;

use App\Models\Lesson;
use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_url_of_image_can_be_accessed_through_accessor()
    {
        $series = Series::factory()->create([
            'image_url' => 'series/fake-image.png'
        ]);

        $image_path = $series->image_path;

        $this->assertEquals($image_path, asset('storage/series/fake-image.png'));
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

    public function test_user_can_get_ordered_lessons()
    {
        $lesson1 = Lesson::factory()->create([ 'episode_number' => 3 ]);
        $lesson2 = Lesson::factory()->create([ 'episode_number' => 2, 'series_id' => 1 ]);
        $lesson3 = Lesson::factory()->create([ 'episode_number' => 1, 'series_id' => 1 ]);

        $orderedLessons = $lesson1->series->getOrderedLessons();


        $this->assertInstanceOf(Lesson::class, $orderedLessons->random());

        $this->assertEquals($orderedLessons->first()->id, 3);
        $this->assertEquals($orderedLessons->last()->id, 1);
        
    }

    public function test_a_user_can_get_series_being_watched()
    {
        // user
        // 2 lessons each for 3 series
        // user completed 2 lessons 1 from series 1 and 1 from series 2
        // getStartedSeries gives us 2 series collections
        // assert random return is instance of Series::class
        // array having ids of these collection have 1 and 2 (SERIES STARTED)
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
}
