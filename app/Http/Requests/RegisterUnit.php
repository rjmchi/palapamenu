<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUnit extends FormRequest
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
            'unit' => 'required|in:[101, 102, 103,104, 201, 202, 203,301, 302, 303, 401, 402, 403, 501, 502, 601, 602, 701, 702, 703, 801, 802, 803, 901, 902, 903, 1001, 1002, 1101, 1102, 1201]',
            'name' => 'required',
            'phone' => 'required|min:10'
        ]; 
    }
    
    public function messages() {
        return [
            'unit.required' => __('You must enter a unit number'),
            'unit.in' => __('The Unit number is not valid'),
            'name.required' => __('You must enter a name'),
            'phone.required'=>__('You must enter a telephone number')
        ];
    }    
}
