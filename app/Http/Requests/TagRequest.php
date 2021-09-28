<?php

namespace App\Http\Requests;

class TagRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1|max:150|unique:tags,name,' . $this?->tag?->id,
        ];
    }
}
