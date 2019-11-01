<?php

namespace App\Http\Requests\Usergroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('cp_permissions_groups')->ignore($this->route('usergroup')),
            ],
        ];
    }
}
