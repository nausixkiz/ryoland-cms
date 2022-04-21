<?php

namespace App\Http\Requests\RealEstate\Facility;

use App\Rules\Status;
use Illuminate\Foundation\Http\FormRequest;

class BaseFacilityRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:60'],
            'status' => ['required', 'string', 'max:60', new  Status()],
        ];
    }
}
