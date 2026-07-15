<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $item = $this->route('item');

        return [
            'item_name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'integer', Rule::exists('categories', 'id')],
            'price' => ['required', 'numeric', 'min:0'],
            'condition' => ['required', Rule::in(['good', 'bad', 'maintenance'])],
            'image' => [ $isUpdate ? 'nullable' : 'required',
                'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'desc' => ['required', 'max:1000']
        ];
    }
}
