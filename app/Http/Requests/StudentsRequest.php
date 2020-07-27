<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
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
        switch($this->method())
        {
            case 'PUT':
            case 'PATCH':
            case 'POST':
                return [
                    'name' => ['required'],
                    'email' => ['required', 'email'],
                    'ra' => ['required', 'unique:students,ra'],
                    'cpf' => ['required', 'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/']
                ];
                break;
            default:
                return [];
                break;
        }
    }

    public function messages()
    {
        switch($this->method())
        {
            case 'PUT':
            case 'PATCH':
            case 'POST':
                return [
                    'name.required' => 'O campo NOME é obrigatório.',
                    'email.required' => 'O campo EMAIL é obrigatório.',
                    'ra.required' => 'O campo RA é obrigatório.',
                    'ra.unique' => 'O RA informado já existente no sistema.',
                    'cpf.required' => 'O campo CPF é obrigatório.',
                    'cpf.regex' => 'O CPF informado é inválido.'
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
