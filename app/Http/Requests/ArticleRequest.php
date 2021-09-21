<?php

namespace App\Http\Requests;

use App\Models\Article;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->route()->getName() === 'articles.store')
        {
            return true;
        }

        $article = Article::findOrFail(
            request()->segment(2)
        );

        return $article->user_id === auth()->id();
    }

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
