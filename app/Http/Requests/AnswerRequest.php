<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
            'description' => 'required|min:1|max:255',
            'question_id' => 'required|numeric',
            'profile_id' => 'required|numeric'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return ['description'=>'Descrição', 'question_id'=>'Pergunta', 'profile_id'=>'Perfil'];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    /* public function messages()
    {
        return [
            //
        ];
    } */
}
