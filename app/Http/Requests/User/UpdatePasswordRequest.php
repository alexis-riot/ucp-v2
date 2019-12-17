<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'actual_password' => 'required',
            'new_password' => 'required',
            'new_confirmed_password' => 'required|min:5|same:new_password',
        ];
    }
}
