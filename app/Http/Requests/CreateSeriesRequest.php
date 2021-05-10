<?php

namespace App\Http\Requests;

use App\Models\Series;
use Illuminate\Support\Str;

class CreateSeriesRequest extends SeriesRequest
{
    
    /**
     * Creates the series from given data
     * image_url comes from storePublicalyAs function called by $this->storeSeriesImage()
     * 
     * @return void
     */
    public function storeImageAndCreateSeries()
    {
        $series = Series::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'image_url' => $this->storeSeriesImage(),
            'description' => $this->description,
        ]);

        session()->flash('success', 'Series created successfully');

        return redirect(route('series.show', $series->slug));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:series,title',
            'image' => 'required|image',
            'description' => 'required',
        ];
    }
}
