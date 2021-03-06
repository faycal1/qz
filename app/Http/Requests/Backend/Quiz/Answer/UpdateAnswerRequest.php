<?php

namespace App\Http\Requests\Backend\Quiz\Answer;

use App\Http\Requests\Request;

class UpdateAnswerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('update-answer');
    }

    public function rules()
    {
        return [
            'body' => 'required',
            'question_id' => 'required',
            'type' => 'required',
            'type' => 'onlyonetrue',
            ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est obligatoire',
            'question_id.required' => 'La Question est obligatoire',
            'type.required' => 'Le type de la reponse obligatoire',
            'type.onlyonetrue' => 'la Question est de type unique et ne peut avoir plusieur vrais reponse',
        ];
    }
}
