<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'password' => ['required',
                'min:6',
                //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed'],
            'email' => 'required|unique:users,email|email',
            //'date_of_birth' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.user.name.required'),
            'surname.required' => trans('validation.user.surname.required'),
            'patronymic.required' => trans('validation.user.patronymic.required'),
            'email.required' => trans('validation.user.email.required'),
            'email.unique' => trans('validation.user.email.unique'),
            'email.email' => trans('validation.user.email.email'),
            'password.required' => trans('validation.user.password.required'),
            'password.min' =>trans('validation.user.password.min'),
            'password.regex' => trans('validation.user.password.regex'),
            'password.confirmed' => trans( 'validation.user.password.confirmed'),
            'date_of_birth.required' => trans('validation.user.date_of_birth.required'),
        ];
    }

}
