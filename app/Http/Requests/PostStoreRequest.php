<?php

namespace App\Http\Requests;

use App\Http\constants\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts,title|string|max:4000',
            'photo' => "required|mimes:jpg,jpeg,png,svg",
            'short_description' => 'required|string|max:200',
            'description' => 'nullable|string|max:4000',
            'status'=>[Rule::in(Constants::POST_ACTIVE,Constants::POST_INACTIVE)],
        ];
    }
}
