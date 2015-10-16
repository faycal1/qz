<?php

namespace App\Http\Requests\Backend\Quiz\Answer;

use App\Http\Requests\Request;

class CreateAnswerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('create-answer');
    }

    public function rules()
    {
        return [
            'body'  =>  'required',
            'score'   =>  'required',
            'question_id' => 'required',
            'type'=>'required'
            ];
    }

    public function messages()
    {
        return [            
            'title.required' => 'Le titre est obligatoire',
            'score.required'   =>  'Le Score est obligatoire',
            'question_id.required' => 'La Question est obligatoire',
            'type.required'=>'Le type de la reponse obligatoire'
        ];
    }
}
