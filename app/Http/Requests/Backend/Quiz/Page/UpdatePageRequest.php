<?php

namespace App\Http\Requests\Backend\Quiz\Page;

use App\Http\Requests\Request;

class UpdatePageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('update-page');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                =>  "required",
            'body'                 =>  'required',
            ];
    }

    public function messages()
    {
        return [
            
            'title.required' => 'Le titre est obligatoire',
            'body.required' => 'La déscription est obligatoire',
        ];
    }
}

