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

    public function rules()
    {
        return [
            'title'  =>  'required',
            'type' => 'required',
            'cour_id' => 'required',
            'pass'=>'required',
            'fail'=>'required',
            'partial'=>'required',
            'time'=>'integer'
            
            ];
    }

    public function messages()
    {
        return [            
            'title.required' => 'Le titre est obligatoire',            
            'cour_id.required' => 'Le cour est obligatoire',
            'type.required' => 'Le Type est obligatoire',
            'pass.required'=>'Le champs Passe est obligatoire',
            'fail.required'=>'Le champs Ne passe pas est obligatoire',
            'partial.required'=>'Le champs Partiel est obligatoire',
            'time.integer'=>'Le champs Temps doit contenir des secondes est obligatoire',
            
        ];
    
    }
}
