<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarketingManagerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'Name'=>'required',
            'Price'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' =>  'Không được để trống tên',
            'Price.required' => 'Không được để trống giá',
        ];
    }
}
