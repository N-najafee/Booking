<?php

namespace App\Http\Requests;

use App\Http\constants\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
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
            'room_id'=>['required','exists:rooms,id'],
            'adult'=>'required',
            'children'=>'required',
            'check_in'=>'required|date_format:Y/m/d|after_or_equal:today',
            'check_out'=>'required|date_format:Y/m/d|after:check_in|after:today'
        ];
    }
}
