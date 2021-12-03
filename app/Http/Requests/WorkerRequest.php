<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkerRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email'=> ['required', Rule::unique('workers')->ignore($this->worker)],
            'phone'=> ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'role_id' => ['required'],
            'status' => ['required']
        ];
    }
}
