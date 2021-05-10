<?php

namespace App\Http\Requests;

use App\Models\Series;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateSeriesRequest extends FormRequest
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
