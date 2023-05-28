<?php

namespace App\Http\Requests;

use App\Http\constants\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoStoreRequest extends FormRequest
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
            'video_code' => 'required|max:50',
            'description' => 'nullable|string|max:100',
            'status'=>Rule::in(Constants::VIDEO_ACTIVE,Constants::VIDEO_INACTIVE),

        ];
    }
}
