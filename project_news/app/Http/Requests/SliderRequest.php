<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $id = $this -> id;
        $conThumb ='bail|required|image|max:500';
        $conName  ='required|min:5|unique:slider,name';
        if(!empty($id)){
            $conThumb ='bail|image|max:500';
            $conName .= ",$id";
        }
        return [
            'name' => $conName,
            'description' => 'required',
            'link' => 'bail|required|min:5|url',
            'status' => 'bail|in:active,inactive',
            'thumb' => $conThumb
        ];
    }
    public function message()
    {
        # code...
    }


}
