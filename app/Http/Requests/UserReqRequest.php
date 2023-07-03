<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserReqRequest extends FormRequest
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
            'request_type' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'telp' => 'required|string',
            'file' => 'nullable|mimes:pdf,jpg,png,jpeg|max:10000'
        ];
    }
}
