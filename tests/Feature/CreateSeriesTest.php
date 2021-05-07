<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_create_a_series()
    {
        $this->withoutExceptionHandling();
        Storage::fake('local');

        $this->post('/admin/series',[
            'title' => 'fake series',
            'image' => UploadedFile::fake()->image('fake-series.png'),
            'description' => 'fake series description',
        ])
        ->assertRedirect('/admin/series')
        ->assertSessionHas('success','Series created successfully');

        $this->assertTrue(Storage::exists("series/fake-series.png"));

        $this->assertDatabaseHas('series',[
            'slug' => 'fake-series'
        ]);
    }

    public function test_a_series_must_have_title()
    {
        $this->post('/admin/series',[
            'title' => '',
            'image' => UploadedFile::fake()->image('fake-series.png'),
            'description' => 'fake series description',
        ])
        ->assertSessionHasErrors('title');
    }

    public function test_a_series_must_have_description()
    {
        $this->post('/admin/series',[
            'title' => '',
            'image' => UploadedFile::fake()->image('fake-series.png'),
        ])
        ->assertSessionHasErrors('description');
    }

    public function test_a_series_must_have_image()
    {
        $this->post('/admin/series',[
            'title' => '',
            'description' => 'fake series description',
        ])
        ->assertSessionHasErrors('image');
    }


    public function test_a_series_must_have_valid_image()
    {
        $this->post('/admin/series',[
            'title' => '',
            'image' => 'STRING_INVALID_IMAGE',
            'description' => 'fake series description',
        ])
        ->assertSessionHasErrors('image');
    }
}