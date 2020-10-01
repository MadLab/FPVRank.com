<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PilotRequest extends FormRequest
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
            "pilotId" => 'nullable',
            "name" => 'required|max:250',
            "username" => 'required|max:250',
            'country' => 'nullable',
            'photo' => 'nullable|mimes:png,jpeg,jpg,jpe'
        ];
    }
}
