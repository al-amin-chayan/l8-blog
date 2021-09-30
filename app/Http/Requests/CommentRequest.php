<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Validation\Rule;

class CommentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commentable_id' => 'required|integer',
            'commentable_type' => [
                'required',
                Rule::in([Article::class, Tag::class, User::class]),
            ],
            'body' => 'required|min:10|max:255',
        ];
    }
}
