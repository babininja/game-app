<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class CheckAnswerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question_id' => 'required|numeric|exists:game_questions,id',
            'answer_id' => 'required|numeric|exists:answers,id',
            'game_id' => 'required|numeric|exists:games,id',
        ];
    }
}