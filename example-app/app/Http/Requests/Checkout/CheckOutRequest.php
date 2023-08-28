<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'payment' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' =>'Vui lòng nhập họ và tên',
            'email.required' =>'Vui lòng nhập email',
            'address.required' =>'Vui lòng nhập địa chỉ',
            'phone.required' =>'Vui lòng nhập số điện thoại',
            // 'payment.required' =>'Vui lòng nhập phương thức thanh toán',
        ];
    }
}
