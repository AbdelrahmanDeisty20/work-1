<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCraftsmen extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'nullable|string',
            'image'=>'nullable|image|max:2048',
            'imageA' => 'nullable|image|max:2048',
            'imageB' => 'nullable|image|max:2048',
            'phone'=>'nullable|integer',
            'governorates_id'=>'nullable|exists:governorates,id',
            'category_id'=>'nullable|exists:categories,id',
            'NationalNumber' => ['nullable', 'digits:14', 'numeric'],
            'city'=>'nullable|string',
            'subscription_status' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'الاسم يجب أن يكون نصاً.',
            'phone.integer' => 'رقم الهاتف يجب أن يكون أرقاماً.',
            'governorates_id.exists' => 'المحافظة المختارة غير موجودة.',
            'category_id.exists' => 'الفئة المختارة غير موجودة.',
            'NationalNumber.digits' => 'الرقم القومي يجب أن يكون 14 رقماً بالضبط.',
            'NationalNumber.numeric' => 'الرقم القومي يجب أن يحتوي على أرقام فقط.',
            'image.image' => 'الملف يجب أن يكون صورة.',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
            'imageA.image' => 'الملف يجب أن يكون صورة.',
            'imageA.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
            'imageB.image' => 'الملف يجب أن يكون صورة.',
            'imageB.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
        ];
    }
}
