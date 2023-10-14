<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarrierManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'address'=>'required',
            'phonenumber'=>'required',
            'email'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>  'Không được để trống tên',
            'address.required' => 'Không được để trống địa chỉ',
            'phonenumber.required' => 'Không được để trống số điện thoại',
            'email.required' => 'Không được để trống email',
        ];
    }
}