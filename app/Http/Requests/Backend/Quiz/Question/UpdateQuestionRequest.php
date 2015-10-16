<?php

namespace App\Http\Requests\Backend\Quiz\Question;

use App\Http\Requests\Request;

class UpdateQuestionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('update-question');
    }

    public function rules()
    {
        return [
            'title'  =>  'required',
            //'body'   =>  'required',
            'cour_id' => 'required',
            ];
    }

    public function messages()
    {
        return [            
            'title.required' => 'Le titre est obligatoire',
            //'body.required' => 'La déscription est obligatoire',
            'cour_id.required' => 'Le Cour est obligatoire'
        ];
    }
}
