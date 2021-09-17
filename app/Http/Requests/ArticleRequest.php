<?php

namespace App\Http\Requests;

class ArticleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:1|max:255',
            'details' => 'required|min:1',
            'images' => 'nullable|image',
            'is_published' => 'nullable',
        ];
    }
}
