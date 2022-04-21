<?php

namespace App\Http\Requests\RealEstate\Project;

use App\Rules\RealEstateStatus;
use App\Rules\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'number_block'=> ['required', 'integer', 'min:1', 'max:100'],
            'number_floor'=> ['required', 'integer', 'min:1', 'max:100'],
            'number_flat'=> ['required', 'integer', 'min:1', 'max:100'],
            'price_from'=> ['required', 'integer'],
            'price_to'=> ['required', 'integer'],
            'contents'=> ['required', 'string'],
            'status'=> ['required', 'string', new RealEstateStatus()],
            'date_sell'=> ['required', 'date'],
            'date_finish'=> ['required', 'date'],
            'is_featured'=> ['nullable', Rule::in(['on', 'off'])],
            'category.*'=> ['required', 'string', 'exists:r_e_categories,slug'],
            'investor'=> ['required', 'integer', 'exists:r_e_investors,id'],
            'feature.*'=> ['required', 'integer', 'exists:r_e_features,id'],
            'city'=> ['required', 'string', 'exists:cities,slug'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp'],
            'gallery.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp'],
        ];
    }
}
