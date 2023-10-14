<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminMarketingManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'namemarketing' => 'required',
            'pricemarketing' => 'required'

        ];
    }

    public function messages(): array
    {
        return [
            'Name.required' => 'Tên danh mục sản phẩm không được trống',
            'name.required' => 'Tên danh mục sản phẩm không được trống'
        ];
    }
}
