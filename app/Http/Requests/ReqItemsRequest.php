<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReqItemsRequest extends FormRequest
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
        $rules = [];

        $subject = $this->input('subject');
        $description = $this->input('description');

        foreach ($subject as $key => $value) {
            $rules["subject.{$key}"] = 'required|string';
        }

        foreach ($description as $key => $value) {
            $rules["description.{$key}"] = 'required|string';
        }

        return $rules;
    }
}
