<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

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
        ])->assertRedirect()->withSession(['success','Series created successfully']);

        $this->assertTrue(Storage::exists("series/fake-series.png"));

        $this->assertDatabaseHas('series',[
            'slug' => 'fake-series'
        ]);
    }
}