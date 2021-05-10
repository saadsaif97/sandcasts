<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateSeriesRequest extends SeriesRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->hasFile('image')) {
            return [
                'title' => "required|unique:series,title,$this->id,id",
                'image' => 'image',
                'description' => 'required',
            ];
        }

        return [
            'title' => "required|unique:series,title,$this->id,id",
            'description' => 'required',
        ];
    }

    
    public function updateSeries($series)
    {
        if ($this->hasFile('image')) {
            Storage::delete($series->image_url);
            $series->image_url = $this->storeSeriesImage();
        }

        $series->title = $this->title;
        $series->slug = Str::slug($this->title);
        $series->description = $this->description;

        $series->save();
    }
    
}
