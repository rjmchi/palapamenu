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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'unit' => [
                'required',
                'in:101, 102, 103, 202, 203, 303, 401, 502, 602, 701, 702, 703, 801, 802, 901, 902, 1001, 1002, 1003, 1101, 1201'
            ],
            'name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'unit.required' => __('You must enter a unit number'),
            'unit.in' => __('Unknown Error'),
            'name.required' => __('You must enter a name')
        ];
    }
}
