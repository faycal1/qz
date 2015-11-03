<?php

namespace App\Http\Requests\Backend\Departement;

use App\Http\Requests\Request;

class UpdateDepartementRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->can('update-departement');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:departements,name,'.$this->departement->id,
            ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Ce département existe deja',
            'name.required' => 'Le nom du département est obligatoire',

        ];
    }
}
