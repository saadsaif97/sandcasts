<?php

namespace Tests\Feature;

use App\Models\User;
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

        $this->loginAdmin();        

        $this->post('/admin/series',[
            'title' => 'fake series',
            'image' => UploadedFile::fake()->image('fake-series.png'),
            'description' => 'fake series description',
        ])
        ->assertRedirect()
        ->assertSessionHas('success','Series created successfully');

        $this->assertTrue(Storage::exists("series/fake-series.png"));

        $this->assertDatabaseHas('series',[
            'slug' => 'fake-series'
        ]);
    }

    public function test_a_series_must_have_title()
    {
        $this->loginAdmin();

        $this->post('/admin/series',[
            'title' => '',
            'image' => UploadedFile::fake()->image('fake-series.png'),
            'description' => 'fake series description',
        ])
        ->assertSessionHasErrors('title');
    }

    public function test_a_series_must_have_description()
    {
        $this->loginAdmin();

        $this->post('/admin/series',[
            'title' => '',
            'image' => UploadedFile::fake()->image('fake-series.png'),
        ])
        ->assertSessionHasErrors('description');
    }

    public function test_a_series_must_have_image()
    {
        $this->loginAdmin();

        $this->post('/admin/series',[
            'title' => '',
            'description' => 'fake series description',
        ])
        ->assertSessionHasErrors('image');
    }


    public function test_a_series_must_have_valid_image()
    {
        $this->loginAdmin();

        $this->post('/admin/series',[
            'title' => '',
            'image' => 'STRING_INVALID_IMAGE',
            'description' => 'fake series description',
        ])
        ->assertSessionHasErrors('image');
    }

    public function test_only_admin_can_create_series()
    {

        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());
        
        $this->get('/admin/series/create')
             ->assertRedirect('/');

    }
}
