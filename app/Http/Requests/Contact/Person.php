<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class Person extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|min:2|max:255',
            'surname'=>'required|min:2|max:80',
            'other'=>'required|min:2|max:255',
            'choices'=>'required',
            'contact_general_id'=>'required'
        ];
    }
}
