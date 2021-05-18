<?php

namespace Tests\Unit;

use App\Models\Lesson;
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

    

    public function test_series_can_get_ordered_lessons()
    {
        $lesson1 = Lesson::factory()->create([ 'episode_number' => 3 ]);
        $lesson2 = Lesson::factory()->create([ 'episode_number' => 2, 'series_id' => 1 ]);
        $lesson3 = Lesson::factory()->create([ 'episode_number' => 1, 'series_id' => 1 ]);

        $orderedLessons = $lesson1->series->getOrderedLessons();


        $this->assertInstanceOf(Lesson::class, $orderedLessons->random());

        $this->assertEquals($orderedLessons->first()->id, 3);
        $this->assertEquals($orderedLessons->last()->id, 1);
        
    }

    
}
