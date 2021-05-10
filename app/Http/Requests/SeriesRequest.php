<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SeriesRequest extends FormRequest
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

}
