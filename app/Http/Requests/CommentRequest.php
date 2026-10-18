<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'body' => ['required', 'min:4'],
            'snippet_id' => ['required', 'exists:snippets,id'],
        ];
    }
}
