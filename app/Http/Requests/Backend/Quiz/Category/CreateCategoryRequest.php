<?php

namespace App\Http\Requests\Backend\Quiz\Category;

use App\Http\Requests\Request;

class CreateCategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return access()->can('create-category');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'  =>  'required|unique:categories',
            'body'   =>  'required'
            ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Ce titre existe deja',
            'title.required' => 'Le titre est obligatoire',
            'body.required' => 'La déscription est obligatoire'
        ];
    }
}

