<?php

namespace App\Http\Requests\Blog\Category;

use App\Rules\Status;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:6', 'max:120', 'unique:categories,slug,' . $this->segment(2)],
            'description' => ['required', 'string', 'min:6', 'max:255'],
            'status' => ['required', 'string', new Status()],
        ];
    }
}
