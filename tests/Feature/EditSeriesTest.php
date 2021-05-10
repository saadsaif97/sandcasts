<?php

namespace Tests\Feature;

use App\Models\Series;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Inline\Element\Strong;
use Tests\TestCase;

class EditSeriesTest extends TestCase
{

    use RefreshDatabase;

    public function test_an_admin_can_edit_a_series_with_image()
    {
        Storage::fake('local');

        $this->withoutExceptionHandling();
        $this->loginAdmin();
        $series = Series::factory()->create();

        $this->put(route('series.update', $series->slug),[
            'title'=> 'updated title',
            'image'=> UploadedFile::fake()->image('fake-image.png'),
            'description'=>'updated description',
        ])
        ->assertRedirect(route('series.index'))
        ->assertSessionHas('success','Series updated successfully');
        
        $this->assertTrue(Storage::exists('series/updated-title.png'));
        
        $this->assertDatabaseHas('series',[
            'title' => 'updated title'
        ]);
    }


    public function test_an_admin_can_edit_a_series_without_image()
    {
        $this->withoutExceptionHandling();
        $this->loginAdmin();
        $series = Series::factory()->create();

        $this->put(route('series.update', $series->slug),[
            'title'=> 'updated title',
            'description'=>'updated description',
        ])
        ->assertRedirect(route('series.index'))
        ->assertSessionHas('success','Series updated successfully');
        
        
        $this->assertDatabaseHas('series',[
            'title' => 'updated title'
        ]);
    }
}
