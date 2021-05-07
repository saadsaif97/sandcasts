<?php

namespace App\Http\Requests;

use App\Models\Series;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Store the image in series folder
     * 
     * @return path to image after storing
     */
    public function storeSeriesImage()
    {
        $imageExtension = $this->image->getClientOriginalExtension();

        $imageName =  Str::slug($this->title).'.'.$imageExtension;

        return $this->image->storePubliclyAs('series', $imageName);
    }

    /**
     * Creates the series from given data
     * image_url comes from storePublicalyAs function called by $this->storeSeriesImage()
     * 
     * @return void
     */
    public function storeImageAndCreateSeries()
    {
        Series::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'image_url' => $this->storeSeriesImage(),
            'description' => $this->description,
        ]);
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
