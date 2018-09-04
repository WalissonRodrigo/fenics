<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:255',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'profile_id' => 'sometimes|numeric',
            'schooling_id' => 'required|numeric'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Nome', 'email' => 'Email', 'phone' => 'Telefone', 'birth_date' => 'Data de Nascimento', 'profile_id' => 'Perfil', 'schooling_id' => 'Nível de Escolaridade'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.email' => 'O campo Email deve conter a estrutura de um email real.',
            'name.required' => 'O campo Nome é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'birth_date.required' => 'O campo Data de Nascimento é obrigatório.',
            'profile.required' => 'Escolher alternativas entre todas as perguntas do Teste Vocacional é obrigatório',
            'schooling_id.required' => 'O campo Nível de Escolaridade é obrigatório.',
            'birth_date.date' => 'Apenas Datas são aceitas no campo de Data de Nascimento',
            'profile.array' => 'Responder ao Teste Vocacional é obrigatório',
            'schooling_id.numeric' => 'Pelo menos 1 opção para o Nível de Escolaridade deve ser preenchido.'
        ];
    }
}
