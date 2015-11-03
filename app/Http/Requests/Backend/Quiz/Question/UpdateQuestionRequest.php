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
            'title' => 'required',
            'type' => 'required',
            'cour_id' => 'required',
            'pass' => 'required',
            'fail' => 'required',
            'partial' => 'required',

            ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est obligatoire',
            'cour_id.required' => 'Le cour est obligatoire',
            'type.required' => 'Le Type est obligatoire',
            'pass' => 'Le champs Passe est obligatoire',
            'fail' => 'Le champs Ne passe pas est obligatoire',
            'partial' => 'Le champs Partiel est obligatoire',

        ];
    }
}
