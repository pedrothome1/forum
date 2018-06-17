<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->filledFieldsRules()->all();
    }

    /**
     * Get all the filled fields.
     *
     * @return array
     */
    public function filledFields()
    {
        return $this->only($this->filledFieldsRules()->keys()->all());
    }

    /**
     * Get only the validation rules for the filled fields.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function filledFieldsRules()
    {
        return collect($this->validationRules())
            ->filter(function ($rules, $field) {
                return $this->filled($field);
            });
    }

    /**
     * Get all possible validation rules that apply to the request.
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'name' => 'required|string|max:191',
            'username' => [
                'required',
                'string',
                'regex:/^([A-z0-9_-])+$/',
                'max:191',
                Rule::unique('users')->ignore($this->user()->username, 'username'),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:191',
                Rule::unique('users')->ignore($this->user()->email, 'email'),
            ],
            'password' => 'required|string|min:6|confirmed',
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
            'username.regex' => 'O nome de usuário deve conter apenas letras (sem acento nem espaços), números ou os caracteres: - ou _',
        ];
    }
}
