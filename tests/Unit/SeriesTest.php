<?php

namespace Tests\Unit;

use App\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
