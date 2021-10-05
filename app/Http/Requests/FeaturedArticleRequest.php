<?php

namespace App\Http\Requests;

class FeaturedArticleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'article_id' => 'required',
            'title' => 'required|min:10|max:255',
            'description' => 'required|min:50',
        ];
    }
}
