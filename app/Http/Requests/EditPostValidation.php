<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Post;
use Illuminate\Http\Request;

class EditPostValidation extends FormRequest
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
    public function rules(Request $request)
    {
        // get id from url
         $id = $request->segment(2);
         $post = Post::find($id);
     
       return  [
           
            'title' => 'required|max:20',
            'description' => 'required|max:255',
            'slug' => ($request->slug != $post->slug ) ? 'required|alpha_dash|min:5|max:255|unique:posts,slug' : '',
            'img' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

    }
}
