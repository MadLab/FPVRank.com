<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PilotUpdateRequest extends FormRequest
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
            "pilotId" => 'required',
            "name" => 'required|max:250',
            "username" => 'required|max:250',
            'country' => 'required',
            'photo' => 'nullable|mimes:png,jpeg,jpg,jpe'
        ];
    }
}
