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
            'description' => 'required|max:255',
            'slug' => 'required|alpha_dash|unique:posts|min:5|max:80',
            'img' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
