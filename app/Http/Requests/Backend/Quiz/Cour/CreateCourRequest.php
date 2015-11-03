<?php

namespace App\Http\Requests\Backend\Quiz\Cour;

use App\Http\Requests\Request;

class CreateCourRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('create-cour');
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:cours',
            'body' => 'required',
            'category_id' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Ce titre existe deja',
            'title.required' => 'Le titre est obligatoire',
            'body.required' => 'La déscription est obligatoire',
            'category_id.required' => 'La categorie est obligatoire',
        ];
    }
}
