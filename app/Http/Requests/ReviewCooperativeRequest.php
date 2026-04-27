<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewCooperativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:approved,rejected',
            'reason' => 'required_if:status,rejected|nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required'     => 'กรุณาระบุสถานะ',
            'status.in'           => 'สถานะต้องเป็น approved หรือ rejected เท่านั้น',
            'reason.required_if'  => 'กรุณาระบุเหตุผลเมื่อปฏิเสธคำขอ',
        ];
    }
}
