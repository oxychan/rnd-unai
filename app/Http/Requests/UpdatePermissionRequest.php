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
            $rules["{$menu->name}_read"] = 'nullable|boolean';
            $rules["{$menu->name}_update"] = 'nullable|boolean';
            $rules["{$menu->name}_create"] = 'nullable|boolean';
            $rules["{$menu->name}_delete"] = 'nullable|boolean';
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        $request = [];
        $menus = Menu::all();

        foreach ($menus as $menu) {
            $request["{$menu->name}_read"] = filter_var($this->input("{$menu->name}_read"), FILTER_VALIDATE_BOOLEAN);
            $request["{$menu->name}_update"] = filter_var($this->input("{$menu->name}_update"), FILTER_VALIDATE_BOOLEAN);;
            $request["{$menu->name}_create"] = filter_var($this->input("{$menu->name}_create"), FILTER_VALIDATE_BOOLEAN);;
            $request["{$menu->name}_delete"] = filter_var($this->input("{$menu->name}_delete"), FILTER_VALIDATE_BOOLEAN);;
        }

        $this->merge($request);
    }
}
