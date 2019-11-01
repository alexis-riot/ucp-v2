<?php

namespace App\Http\Requests\Bug;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bug_type' => 'required',
            'bug_priority' => 'required',
            'subject' => 'required',
            'content' => 'required',
        ];
    }
}
