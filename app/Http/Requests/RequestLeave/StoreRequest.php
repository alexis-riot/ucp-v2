<?php

namespace App\Http\Requests\RequestLeave;

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
            'name' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'head' => 'integer',
            'type' => 'required',
            'reason' => 'required',
        ];
    }
}
