<?php

namespace App\Http\Requests\RealEstate\Cateogry;

use App\Rules\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
            'name' => ['required', 'string', 'min:3', 'max:120', 'unique:categories,slug,' . $this->segment(3)],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['required', 'string', new Status()],
        ];
    }
}
