<?php

namespace Tests\Unit;

use App\Models\Lesson;
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
        $this->assertEquals($lesson1->nextLesson()->id, $lesson1->id);
        
        $this->assertEquals($lesson1->previousLesson()->id, $lesson2->id);
        $this->assertEquals($lesson2->previousLesson()->id, $lesson3->id);
        $this->assertEquals($lesson3->previousLesson()->id, $lesson3->id);

    }

    
}
