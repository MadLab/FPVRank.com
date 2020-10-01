<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EventRequest extends FormRequest
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
            "multigpId" => 'nullable|unique:pilots',
            "name" => 'required|max:250',
            "location" => 'required|max:250',
            "classId" => 'required|numeric',
            "date" => 'required',
            "notes.*" => 'nullable|max:250',
            'photo' => 'nullable|mimes:png,jpeg,jpg,jpe'
        ];
    }
}
