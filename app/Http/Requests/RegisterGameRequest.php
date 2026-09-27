<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class RegisterGameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'description'  => 'required|string|max:500',
            'rating'  => 'required|integer|between:1,5',
            'release_date' => 'required|date',
            'category' => 'required|integer|exists:categories,id',
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'O nome do jogo é obrigatório.',
            'name.string' => 'O nome do jogo deve ser uma string válida.',
            'name.max' => 'O nome do jogo deve ter no máximo 255 caracteres.',
            'description.required' => 'A descrição do jogo é obrigatória.',
            'description.string' => 'A descrição deve ser uma string válida.',
            'description.max' => 'A descrição deve ter no máximo 500 caracteres.',
            'release_date.required' => 'A data de lançamento é obrigatória.',
            'release_date.date' => 'A data de lançamento deve ser uma data válida',
            'category.required' => 'A categoria é obrigatória',
            'rating.required' => 'A nota é obrigatória',
        ];
    }
}