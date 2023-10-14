<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'price'=>'required',
            'category'=>'required',
            'subCategory'=>'required',
            'description'=>'required',
            'quantity'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' =>  'Không được để trống tên sản phẩm',
            'price.required' => 'Không được để trống giá sản phẩm',
            'category.required' => 'Không được để trống loại sản phẩm',
            'subCategory.required' => 'Không được để trống kiểu sản phẩm',
            'description.required' => 'Không được để trống mô tả',
            'quantity.required'=>   'Không được để trống số lượng sản phẩm',
        ];
    }
}
