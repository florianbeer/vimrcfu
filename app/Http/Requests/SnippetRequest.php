<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SnippetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:4'],
            'body' => ['required'],
            'description' => ['required'],
            'tags' => ['nullable', 'string'],
        ];
    }
}
