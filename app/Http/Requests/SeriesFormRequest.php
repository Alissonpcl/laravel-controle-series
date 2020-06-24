<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'nome' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo :attribute é obrigatório',
            //OU
            //'nome.required' => 'Campo nome é obrigatório',
            'min' => 'Quantidade mínima do campo :attribute é :min caracteres'
        ];
    }
}
