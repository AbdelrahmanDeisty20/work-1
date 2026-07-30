<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storecraftsmen extends FormRequest
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
            'name' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'imageA' => 'nullable|image|max:2048',
            'imageB' => 'nullable|image|max:2048',
            'phone' => 'required|string',
            'governorates_id' => 'required|exists:governorates,id',
            'category_id' => 'required|exists:categories,id',
            'NationalNumber' => ['nullable', 'digits:14', 'numeric'],
            'city' => 'required|string',
            'startDate'=> 'required|date_format:Y-m-d',
            'subscription_status' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يرجى إدخال اسم صاحب الحرفة.',
            'name.string' => 'الاسم يجب أن يكون نصاً.',
            'phone.required' => 'يرجى إدخال رقم الهاتف.',
            'governorates_id.required' => 'يرجى اختيار المحافظة.',
            'governorates_id.exists' => 'المحافظة المختارة غير موجودة.',
            'category_id.required' => 'يرجى اختيار الفئة.',
            'category_id.exists' => 'الفئة المختارة غير موجودة.',
            'NationalNumber.required' => 'يجب إدخال الرقم القومي.',
            'NationalNumber.digits' => 'الرقم القومي يجب أن يكون 14 رقماً بالضبط.',
            'NationalNumber.numeric' => 'الرقم القومي يجب أن يحتوي على أرقام فقط.',
            'city.required' => 'يرجى إدخال المدينة.',
            'startDate.required' => 'يرجى إدخال تاريخ الاشتراك.',
            'startDate.date_format' => 'تنسيق التاريخ غير صحيح.',
            'image.image' => 'الملف يجب أن يكون صورة.',
            'image.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
            'imageA.image' => 'الملف يجب أن يكون صورة.',
            'imageA.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
            'imageB.image' => 'الملف يجب أن يكون صورة.',
            'imageB.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميجابايت.',
        ];
    }
}
