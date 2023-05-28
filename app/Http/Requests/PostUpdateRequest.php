<?php

namespace App\Http\Requests;

use App\Http\constants\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:4000|unique:posts,title,'.$this->post->id,
            'photo' => "mimes:jpg,jpeg,png,svg",
            'short_description' => 'required|string|max:200',
            'description' => 'nullable|string|max:4000',
            'status'=>[Rule::in(Constants::POST_ACTIVE,Constants::POST_INACTIVE)],
        ];
    }
}
