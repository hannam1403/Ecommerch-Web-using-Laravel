<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBannerManagerRequest extends FormRequest
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
            'BannerName' => 'required',
            'ImageBanner' => 'required|image'

        ];
    }

    public function messages(): array
    {
        return [
            'BannerName.required' => 'Tên banner không được trống',
            'ImageBanner.required' => 'Ảnh banner không được trống',
            'ImageBanner.image' => 'Upload file không đúng định dạng ảnh'
        ];
    }
}
