<?php

namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'active' => 'nullable',
            'points' => 'required|numeric|min:5|max:20',
            'answer' => 'required|array',
            'answer.*.title' => 'required|string',
            'answer.*.sort_order' => 'required|numeric',
            'answer.*.is_correct' => 'nullable',
        ];
    }
}