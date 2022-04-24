<?php

namespace App\Http\Requests\RealEstate\Property;

use App\Rules\RealEstateStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
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
            'name'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string', 'max:400'],
            'location'=> ['required', 'string', 'max:255'],
            'latitude'=> ['required', 'string', 'max:255'],
            'longitude'=> ['required', 'string', 'max:255'],
            'number_bedroom'=> ['required', 'integer', 'min:1', 'max:10'],
            'number_bathroom'=> ['required', 'integer', 'min:1', 'max:10'],
            'number_floor'=> ['required', 'integer', 'min:1', 'max:10'],
            'square'=> ['required', 'integer', 'min:1'],
            'price'=> ['required', 'integer', 'min:1'],
            'facility.*'=> ['nullable', 'array'],
            'facility.*.id'=> ['nullable', 'exists:r_e_facilities,id'],
            'facility.*.distance'=> ['nullable', 'min:1'],
            'contents'=> ['required', 'string'],
            'status'=> ['required', 'string', new RealEstateStatus()],
            'type'=> ['required', 'string', Rule::in(['rent', 'sell'])],
            'is_featured'=> ['nullable', Rule::in(['on', 'off'])],
            'category.*'=> ['required', 'string', 'exists:r_e_categories,slug'],
            'project'=> ['required', 'string', 'exists:r_e_projects,slug'],
            'feature.*'=> ['required', 'integer', 'exists:r_e_features,id'],
            'city'=> ['required', 'string', 'exists:cities,slug'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp'],
            'gallery.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp'],
        ];

    }
}
