<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:255',
            'body' => 'required',
            'body' => 'required',
            'tags' => 'required',
            'category_id' => 'required',
            'created_at' => "required|date|after:yesterday",
            'image' => "file|image|required|mimes:jpeg,png"

        ];
    }
}
