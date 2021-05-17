<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WatchSeriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_complete_a_lesson_from_series()
    {
        $this->flushRedis();

        $user = User::factory()->create();
        $this->actingAs($user);
        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create([
            'series_id' => 1
        ]);
        
        $this->post("/series/complete-lesson/{$lesson1->id}")
             ->assertStatus(200)
             ->assertJson([
               'status' => 'ok'
             ]);

        // assert lesson is completed
        $this->assertTrue($user->hasCompletedLesson($lesson1));
        $this->assertFalse($user->hasCompletedLesson($lesson2));
    }
}
