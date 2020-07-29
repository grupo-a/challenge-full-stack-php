<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            case 'POST':
                return [
                    'email' => ['required', 'email'],
                    'password' => ['required']
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
            case 'POST':
                return [
                    'email.required' => 'O campo EMAIL é obrigatório.',
                    'email.email' => 'O EMAIL informado é inválido.',
                    'password.required' => 'O campo SENHA é obrigatório.'
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
