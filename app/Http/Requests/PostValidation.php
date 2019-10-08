<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:20',
            'description' => 'required|max:150',
            'slug' => 'required|alpha_dash|min:5|max:255',
            'img' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
