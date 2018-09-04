<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'like' => 'required|min:3|max:255',
            'values' => 'required|min:3|max:255',
            'perspective' => 'required|min:3|max:255',
            'view' => 'required|min:3|max:255',
            'fear' => 'required|min:3|max:255',
            'expertise' => 'required|min:3|max:255'
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
            'name' => 'Perfil', 'like' => 'Gostos', 'values' => 'Valores', 'perspective' => 'Perspectivas', 'view' => 'Visão', 'fear' => 'Receios', 'expertise' => 'Áreas de Atuação'
        ];
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
