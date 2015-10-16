<?php

namespace App\Http\Requests\Backend\Quiz\Question;

use App\Http\Requests\Request;

class CreateQuestionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('create-question');
    }

    ublic function rules()
    {
        return [
            'title'  =>  'required',
            'type' => 'required',
            'cour_id' => 'required',
            'score'   =>  'required|integer|between:0,100',
            ];
    }

    public function messages()
    {
        return [            
            'title.required' => 'Le titre est obligatoire',            
            'cour_id.required' => 'Le cour est obligatoire',
            'type.required' => 'Le Type est obligatoire',
            'score.required'=> 'Le Score est obligatoire',
            'score.integer'=> 'Le Score doit contenir un chiffre',
            'score.between'=> 'Le Score doit contenir un chiffre entre 0 et 100'
        ];
    }
    }
}
