<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewEventRequest extends FormRequest
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
            'titulo_evento' => 'required|min:5|max:100',
            'descricao_evento' => 'required|min:3|max:255',
            'inicio_evento' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'termino_evento' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'hora_inicio_evento' => 'required|date_format:H:i|after:08:59|before:18:01',
            'hora_final_evento' => 'required|date_format:H:i|before:18:01|after:hora_inicio_evento',
        ];
    }

    public function messages()
    {
        return [
            'titulo_evento.required' => 'O campo [Título] é obrigatório!',
            'titulo_evento.min' => 'O campo [Título] precisa ter no mínimo 5 caracteres.',
            'titulo_evento.max' => 'O campo [Título] precisa ter no máximo 100 caracteres.',
            'descricao_evento.required' => 'O campo [Descrição] é obrigatório!',
            'descricao_evento.min' => 'O campo [Descrição] precisa ter no mínimo 3 caracteres.',
            'descricao_evento.max' => 'O campo [Descrição] precisa ter no máximo 255 caracteres.',
            'inicio_evento.required' => 'O campo [Início do Evento] é obrigatório!',
            'inicio_evento.date_format' => 'O campo [Início do Evento] não está em um formato de data aceitável.',
            'inicio_evento.after_or_equal' => 'O campo [Início do Evento] não pode ser menor que a data atual.',
            'termino_evento.required' => 'O campo [Término do Evento] é obrigatório!',
            'termino_evento.date_format' => 'O campo [Término do Evento] não está em um formato de data aceitável.',
            'termino_evento.after_or_equal' => 'O campo [Término do Evento] não pode ser menor que a data atual.',
            'hora_inicio_evento.required' => 'O campo [Hora de início] é obrigatório!',
            'hora_inicio_evento.date_format' => 'O campo [Hora de início] não está em um formato de data aceitável.',
            'hora_inicio_evento.after' => 'O campo [Hora de início] precisa ser maior ou igual que 09:00.',
            'hora_inicio_evento.before' => 'O campo [Hora de início] precisa ser menor ou igual que 18:00.',
            'hora_final_evento.required' => 'O campo [Hora de término] é obrigatório!',
            'hora_final_evento.date_format' => 'O campo [Hora de término] não está em um formato de data aceitável.',
            'hora_final_evento.after' => 'O campo [Hora de término] precisa ser maior que o horário de início.',
            'hora_final_evento.before' => 'O campo [Hora de término] precisa ser menor ou igual que 18:00.',
        ];
    }

}
