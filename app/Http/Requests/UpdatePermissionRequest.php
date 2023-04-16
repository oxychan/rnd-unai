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
            $menuName = str_replace(' ', '_', $menu->name);
            $request["{$menuName}_read"] = filter_var($this->input("{$menuName}_read"), FILTER_VALIDATE_BOOLEAN);
            $request["{$menuName}_update"] = filter_var($this->input("{$menuName}_update"), FILTER_VALIDATE_BOOLEAN);;
            $request["{$menuName}_create"] = filter_var($this->input("{$menuName}_create"), FILTER_VALIDATE_BOOLEAN);;
            $request["{$menuName}_delete"] = filter_var($this->input("{$menuName}_delete"), FILTER_VALIDATE_BOOLEAN);;
        }

        $this->merge($request);
    }
}
