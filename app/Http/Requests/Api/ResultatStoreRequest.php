<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ResultatStoreRequest extends FormRequest
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
            'score' => ['required', 'string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'quiz_id' => ['required', 'integer', 'exists:quizzes,id'],
            'reponse_id' => ['required', 'integer', 'exists:reponses,id'],
        ];
    }
}
