<?php

namespace Tests\Unit;

use App\Models\Lesson;
use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonTest extends TestCase
{

    use RefreshDatabase;
    
    /**
     * Test a lesson can get next and previous lessons
     * Ordered by the episode number
     */
    public function test_a_lesson_can_get_next_and_previous_lesson()
    {
        
        $lesson1 = Lesson::factory()->create([ 'episode_number' => 3 ]);
        $lesson2 = Lesson::factory()->create([ 'episode_number' => 2, 'series_id' => 1 ]);
        $lesson3 = Lesson::factory()->create([ 'episode_number' => 1, 'series_id' => 1 ]);

        $this->assertEquals($lesson2->nextLesson()->id, $lesson1->id);
        $this->assertEquals($lesson3->nextLesson()->id, $lesson2->id);
        $this->assertNull($lesson1->nextLesson());
        
        $this->assertEquals($lesson1->previousLesson()->id, $lesson2->id);
        $this->assertEquals($lesson2->previousLesson()->id, $lesson3->id);
        $this->assertNull($lesson3->previousLesson());

    }

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
}
