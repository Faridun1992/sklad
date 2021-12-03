<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,bmp,png,jpg', 'max:2048'],
            'title' => ['required', 'min:4', 'max:255', Rule::unique('products')->ignore($this->product) ],
            'category_id' => ['required', 'integer'],
            'code' => ['required', 'integer', 'min:13', Rule::unique('products')->ignore($this->product)],
            'vendor_code' => ['nullable', Rule::unique('products')->ignore($this->product)],
            'storage_id' => ['required', 'integer'],
        ];
    }
}
