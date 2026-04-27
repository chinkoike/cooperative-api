<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCooperativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255|unique:cooperative_requests,name',
            'member_count' => 'required|integer|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'กรุณากรอกชื่อสหกรณ์',
            'name.unique'           => 'ชื่อสหกรณ์นี้มีในระบบแล้ว',
            'member_count.required' => 'กรุณากรอกจำนวนสมาชิก',
            'member_count.min'      => 'จำนวนสมาชิกต้องมีอย่างน้อย 10 คน',
        ];
    }
}
