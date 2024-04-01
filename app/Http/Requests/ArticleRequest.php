<?php

namespace App\Http\Requests;

use App\Support\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    use GeneralTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>'required|string|max:100',
            'body' =>'required|string|max:250',
         ];
    }
}
