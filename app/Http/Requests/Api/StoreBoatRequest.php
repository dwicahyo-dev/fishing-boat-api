<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreBoatRequest extends FormRequest
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
        return [
            'code' => ['required'],
            'name' => ['required'],
            'owner' => ['required'],
            'address' => ['required'],
            'dimension' => ['required'],
            'captain' => ['required'],
            'amount' => ['required'],
            'picture' => ['required', File::types(['png', 'jpg', 'jpeg'])->max(10240)],
            'license_number' => ['required'],
            'document_license' => ['required', File::types(['png', 'jpg', 'jpeg'])->max(10240)],
        ];
    }
}
