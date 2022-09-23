<?php

namespace App\Http\Requests\Mcrlogs;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest 
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
			'sto' => 'required|max:255',
			'timing' => 'required|max:255',
			'programmes' => 'required|max:255',
			'remarks' => 'required|max:255',
			'squeezbacks' => 'required|max:255',
			'tc' => 'required|max:255',
			'traffic' => 'required|max:255',
			'handed_over_to' => 'required|max:255',
			'user_id' => 'required|max:255',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
     
        ];
    }

}
