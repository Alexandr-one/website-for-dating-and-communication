<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
            'email'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.user.name.required'),
            'surname.required' => trans('validation.user.surname.required'),
            'patronymic.required' => trans('validation.user.patronymic.required'),
            'email.required' => trans("validation.user.email.required"),
        ];
    }
}
