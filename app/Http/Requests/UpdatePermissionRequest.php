<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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

        $menus = Menu::all();

        foreach ($menus as $menu) {
            $rules["{$menu->nama}_read"] = 'nullable|boolean';
            $rules["{$menu->nama}_update"] = 'nullable|boolean';
            $rules["{$menu->nama}_create"] = 'nullable|boolean';
            $rules["{$menu->nama}_delete"] = 'nullable|boolean';
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        $request = [];
        $menus = Menu::all();

        foreach ($menus as $menu) {
            $request["{$menu->nama}_read"] = filter_var($this->input("{$menu->nama}_read"), FILTER_VALIDATE_BOOLEAN);
            $request["{$menu->nama}_update"] = filter_var($this->input("{$menu->nama}_update"), FILTER_VALIDATE_BOOLEAN);;
            $request["{$menu->nama}_create"] = filter_var($this->input("{$menu->nama}_create"), FILTER_VALIDATE_BOOLEAN);;
            $request["{$menu->nama}_delete"] = filter_var($this->input("{$menu->nama}_delete"), FILTER_VALIDATE_BOOLEAN);;
        }

        $this->merge($request);
    }
}
