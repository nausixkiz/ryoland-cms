<?php

namespace App\Http\Requests\Blog;

use App\Constants\StatusConst;
use App\Rules\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:6', 'max:100'],
            'description' => ['required', 'string', 'min:6', 'max:255'],
            'contents' => ['required', 'string'],
            'status' => ['required', 'string', new Status()],
            'category' => ['required'],
            'thumbnail' => ['image', 'mimes:jpg,jpeg,png,bmp'],
            'tags' => ['required', 'string'],
        ];
    }
}
