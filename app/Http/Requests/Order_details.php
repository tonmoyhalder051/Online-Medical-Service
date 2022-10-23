<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class order_details extends FormRequest
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
            'email'=>'email',
            'name'=>'string|min:3|max:20',
            'address'=>'string|min:10|max:100',
            'mobile'=>'',
            'age'=>'numeric|min:1|max:100',
            'gender'=>'string',
            'blood_group'=>'string',
            'appointment_date'=>'date|after_or_equal:'.now(),



        ];
    }
}
