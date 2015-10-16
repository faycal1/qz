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
            'cour_id' => 'required',
            ];
    }

    public function messages()
    {
        return [            
            'title.required' => 'Le titre est obligatoire',            
            'cour_id.required' => 'Le cour est obligatoire'
        ];
    }
}
