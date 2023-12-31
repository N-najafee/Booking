<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:rooms',
            'price' => 'required|int',
            'description' => 'required|string|max:5000',
            'size' => 'nullable|string',
            'total_rooms' => 'required|int',
            'total_bathroom' => 'nullable|int',
            'total_balconies' => 'nullable|int',
            'total_guests' => 'nullable|int',
            'total_beds' => 'nullable|int',
            'main_photo' => 'required|mimes:jpg,jpeg,png,svg',
            'video_code' => 'nullable|string|max:255',
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,svg',
            'amenity' => 'required|array',
        ];
    }
}
