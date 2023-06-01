<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeeEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_event' => 'required|numeric|exists:events,id_event',
        ];
    }

    public function messages()
    {
        return [
            'id_event.required' => 'O campo [id_event] é obrigatório!',
            'id_event.numeric' => 'O campo [id_event] precisa ser numérico!',
            'id_event.exists' => 'O campo [id_event] não foi encontrado na base de dados!',
        ];
    }

}
