<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GlickoValuesRequest extends FormRequest
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
        return [
            'rating' => 'required',
            'rd' => 'required',
            'volatility' => 'required',
            'mu' => 'nullable',
            'phi' => 'nullable',
            'sigma' => 'nullable',
            'systemconstant' => 'required',
            'pi2' => 'required',            
        ];
    }
}
