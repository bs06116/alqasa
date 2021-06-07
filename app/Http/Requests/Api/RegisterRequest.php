<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|unique:clients',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:clients',
            'google_lat' => 'required',
            'google_lon' => 'required',
            'device_id' => 'required'
        ];
    }

    public $validator = null;
    protected function failedValidation($validator)
    {
        $this->validator = $validator;
    }

    /*public function messages()
    {
        return [
            'name.required' => 'A title is required',
            'email.required'  => 'A email is required',
            'email.unique'  => 'A email is unique',
            'password.required'  => 'A password is required',
            'password.confirmed'  => 'A password is confirmed',
            'phone.required'  => 'A phone is required',
            'phone.unique'  => 'A phone is unique',
            'gender.required'  => 'A gender is required',
        ];
    }*/
}
