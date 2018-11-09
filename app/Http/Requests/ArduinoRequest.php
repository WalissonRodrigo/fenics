<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ArduinoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'port' => 'required|min:1|max:255',
            'command' => 'required|min:1|max:255'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return ['port' => 'Porta USB', 'command' => 'Comando para enviar'];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    /* public function messages()
    {
        return [
            'port.email' => 'O campo Porta USB é obrigatório.',
            'command.required' => 'O campo Comando para enviar é obrigatório.',
        ];
    } */
}
