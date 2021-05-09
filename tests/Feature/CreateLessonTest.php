<?php

namespace Tests\Feature;

use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateLessonTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test an admin can create a lesson.
     *
     * @return void
     */
    public function test_an_admin_can_create_a_lesson()
    {
        $this->withoutExceptionHandling();

        $this->loginAdmin();
        $series = Series::factory()->create();
        $lesson = [
            "title" => 'new lesson',
            "episode_number" => 213213,
            "video_id" => 11223344,
            "description" => "description"
        ];
        $this->postJson("/admin/$series->id/lessons", $lesson)
            ->assertStatus(201)
            ->assertJson($lesson);


        $this->assertDatabaseHas('lessons',[
            'title'=>'new lesson'
        ]);
    }


    public function test_a_lesson_has_title()
    {
        $this->loginAdmin();
        $series = Series::factory()->create();
        $lesson = [
            "episode_number" => 213213,
            "video_id" => 11223344,
            "description" => "description"
        ];
        $this->postJson("/admin/$series->id/lessons", $lesson)
            ->assertStatus(422);

    }

    public function test_a_lesson_has_description()
    {
        $this->loginAdmin();
        $series = Series::factory()->create();
        $lesson = [
            "title" => 'new lesson',
            "episode_number" => 213213,
            "video_id" => 11223344,
        ];
        $this->post("/admin/$series->id/lessons", $lesson)
            ->assertSessionHasErrors('description');

    }

    public function test_a_lesson_has_an_episode_number()
    {
        $this->loginAdmin();
        $series = Series::factory()->create();
        $lesson = [
            "title" => "new lesson",
            "description" => "description",
            "video_id" => 11223344,
        ];
        $this->post("/admin/$series->id/lessons", $lesson)
            ->assertSessionHasErrors('episode_number');

    }


    public function test_a_lesson_has_a_video_id()
    {
        $this->loginAdmin();
        $series = Series::factory()->create();
        $lesson = [
            "title" => "new lesson",
            "description" => "description",
            "episode_number" => 11223344,
        ];
        $this->post("/admin/$series->id/lessons", $lesson)
            ->assertSessionHasErrors('video_id');

    }
}
