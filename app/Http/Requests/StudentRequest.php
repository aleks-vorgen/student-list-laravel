<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|min:3|max:20',
            'surname'   => 'required|min:5|max:20',
            'faculty_id' => 'required',
            'course'    => 'required|min:1|max:5',
        ];
    }
}
