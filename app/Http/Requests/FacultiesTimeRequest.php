<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultiesTimeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'faculty_id' => 'required',
            'work_date' => 'required',
        ];
    }
}
