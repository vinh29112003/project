<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Constraint\IsTrue;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'comment' => 'required|string|min:5|max:500',
    ];
}

public function messages()
{
    return [
        'comment.required' => 'Bạn chưa nhập nội dung đánh giá.',
        'comment.min' => 'Nội dung đánh giá phải có ít nhất 5 ký tự.',
        'comment.max' => 'Nội dung đánh giá không được vượt quá 500 ký tự.',
    ];
}

}
