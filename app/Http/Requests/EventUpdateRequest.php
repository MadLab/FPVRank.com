<?php

namespace App\Http\Requests;

use Auth;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => 'required|max:250',
            "location" => 'required|max:250',
            "classId" => 'required|numeric',
            "date" => 'required',
            "notes.*" => 'nullable|max:250',
            'photo' => 'nullable|mimes:png,jpeg,jpg,jpe'
        ];
    }
}
