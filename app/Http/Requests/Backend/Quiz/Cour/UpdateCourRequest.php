<?php

namespace App\Http\Requests\Backend\Quiz\Cour;

use App\Http\Requests\Request;

class UpdateCourRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('update-cour');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                =>  "required|unique:cours,title,".$this->cour->id,
            'body'                 =>  'required',
            ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Ce titre existe deja',
            'title.required' => 'Le titre est obligatoire',
            'body.required' => 'La déscription est obligatoire',
        ];
    }
}
